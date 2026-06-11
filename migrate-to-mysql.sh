#!/bin/bash
# =============================================================
# BPAD NTT: SQLite → MySQL Migration Script
# Run this on the VPS: bash migrate-to-mysql.sh
# =============================================================
set -e

PROJECT="/www/wwwroot/bpad"
SQLITE_FILE="$PROJECT/database/database.sqlite"
SQLITE_BACKUP="$PROJECT/database/database.sqlite.backup-$(date +%Y%m%d_%H%M%S)"

echo "============================================"
echo "  BPAD NTT: SQLite → MySQL Migration"
echo "============================================"
echo ""

# --- Step 1: Verify project exists ---
if [ ! -d "$PROJECT" ]; then
    echo "ERROR: Project directory $PROJECT not found!"
    exit 1
fi

# --- Step 2: Check SQLite file exists ---
if [ ! -f "$SQLITE_FILE" ]; then
    echo "WARNING: No SQLite database found at $SQLITE_FILE"
    echo "         Will do a fresh MySQL install (no data to migrate)."
    SKIP_IMPORT=true
else
    SKIP_IMPORT=false
    echo "[1/7] Backing up SQLite database..."
    cp "$SQLITE_FILE" "$SQLITE_BACKUP"
    echo "  Backup saved to: $SQLITE_BACKUP"
fi

# --- Step 3: Check MySQL/MariaDB is available ---
echo ""
echo "[2/7] Checking MySQL/MariaDB..."
if ! command -v mysql &> /dev/null; then
    echo "ERROR: MySQL/MariaDB is not installed!"
    echo "Install it via aaPanel → App Store → MySQL/MariaDB"
    exit 1
fi

MYSQL_ROOT_PASS=""
echo "Enter MySQL root password:"
read -s MYSQL_ROOT_PASS

# Test connection
if ! mysql -u root -p"$MYSQL_ROOT_PASS" -e "SELECT 1" &> /dev/null; then
    echo "ERROR: Cannot connect to MySQL with the provided password."
    exit 1
fi
echo "  MySQL connection OK."

# --- Step 4: Create database and user ---
echo ""
echo "[3/7] Creating MySQL database and user..."

# Generate a random password for the app user
DB_PASS=$(openssl rand -base64 18 | tr -dc 'A-Za-z0-9' | head -c 20)

mysql -u root -p"$MYSQL_ROOT_PASS" <<EOF
CREATE DATABASE IF NOT EXISTS bpadntt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'bpadntt'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON bpadntt.* TO 'bpadntt'@'localhost';
FLUSH PRIVILEGES;
EOF

echo "  Database: bpadntt"
echo "  User:     bpadntt"
echo "  Password: ${DB_PASS}"
echo "  (Save these credentials!)"

# --- Step 5: Update .env ---
echo ""
echo "[4/7] Updating .env..."

cd "$PROJECT"

# Backup .env
cp .env ".env.backup-$(date +%Y%m%d_%H%M%S)"

# Update database config in .env
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
sed -i 's/^# DB_HOST=.*/DB_HOST=127.0.0.1/' .env
sed -i 's/^# DB_PORT=.*/DB_PORT=3306/' .env
sed -i 's/^# DB_DATABASE=.*/DB_DATABASE=bpadntt/' .env
sed -i 's/^# DB_USERNAME=.*/DB_USERNAME=bpadntt/' .env
sed -i "s|^# DB_PASSWORD=.*|DB_PASSWORD=${DB_PASS}|" .env

# If DB_HOST/DB_PORT etc don't exist (commented differently), add them
grep -q "^DB_HOST=" .env || echo "DB_HOST=127.0.0.1" >> .env
grep -q "^DB_PORT=" .env || echo "DB_PORT=3306" >> .env
grep -q "^DB_DATABASE=" .env || echo "DB_DATABASE=bpadntt" >> .env
grep -q "^DB_USERNAME=" .env || echo "DB_USERNAME=bpadntt" >> .env
grep -q "^DB_PASSWORD=" .env || echo "DB_PASSWORD=${DB_PASS}" >> .env

echo "  .env updated."

# --- Step 6: Clear caches and run migrations ---
echo ""
echo "[5/7] Clearing caches and running migrations..."

php artisan optimize:clear
php artisan migrate:fresh --force

echo "  MySQL tables created."

# --- Step 7: Import data from SQLite ---
if [ "$SKIP_IMPORT" = false ]; then
    echo ""
    echo "[6/7] Importing data from SQLite backup..."
    php artisan bpad:migrate-from-sqlite "$SQLITE_BACKUP"
else
    echo ""
    echo "[6/7] Skipping data import (no SQLite file found)."
fi

# --- Step 8: Seed and finalize ---
echo ""
echo "[7/7] Running seeders and finalizing..."

php artisan db:seed --force
php artisan optimize:clear
php artisan route:cache

echo ""
echo "============================================"
echo "  Migration Complete!"
echo "============================================"
echo ""
echo "MySQL Credentials:"
echo "  Host:     127.0.0.1"
echo "  Port:     3306"
echo "  Database: bpadntt"
echo "  Username: bpadntt"
echo "  Password: ${DB_PASS}"
echo ""
echo "DBeaver SSH Tunnel Setup:"
echo "  SSH Host: 212.85.26.65 (port 22)"
echo "  DB Host:  localhost (port 3306)"
echo "  Database: bpadntt"
echo "  Username: bpadntt"
echo "  Password: (the password above)"
echo ""
echo "Next steps:"
echo "  1. Visit the website and verify it works"
echo "  2. If admin was imported, try logging in"
echo "  3. If not, run: php artisan bpad:admin"
echo ""

# Save credentials to file for reference
cat > "$PROJECT/.mysql-credentials" <<EOF
MySQL Credentials for BPAD NTT
==============================
Host:     127.0.0.1
Port:     3306
Database: bpadntt
Username: bpadntt
Password: ${DB_PASS}
Created:  $(date)
EOF

echo "Credentials saved to: $PROJECT/.mysql-credentials"
