// Public Laravel data helper. Semua konten publik dibaca dari API Laravel.
(function () {
  const endpoints = {
    posts: '/api/public/posts',
    settings: '/api/public/settings',
    ppidDocuments: '/api/public/ppid-documents'
  };
  const FETCH_TIMEOUT_MS = 8000;

  async function fetchJson(url) {
    const controller = new AbortController();
    const timeout = window.setTimeout(() => controller.abort(), FETCH_TIMEOUT_MS);

    try {
      const response = await fetch(url, {
        headers: { Accept: 'application/json' },
        cache: 'no-store',
        signal: controller.signal
      });

      if (!response.ok) throw new Error(`Gagal memuat ${url}`);
      const data = await response.json();
      return Array.isArray(data) ? data : [];
    } catch (error) {
      console.warn(error);
      return null;
    } finally {
      window.clearTimeout(timeout);
    }
  }

  function toDateOnly(value) {
    return value ? String(value).slice(0, 10) : '';
  }

  function postToBerita(post, index = 0) {
    const themes = ['blue', 'green', 'amber'];

    return {
      id: post.id,
      slug: post.slug,
      judul: post.title,
      kategori: post.category || 'Berita',
      tanggal: toDateOnly(post.published_at || post.updated_at),
      ikon: 'ti-news',
      tema: themes[index % themes.length],
      ringkasan: post.summary || post.content || '',
      isi: post.content || '',
      link: post.slug ? `/berita/${encodeURIComponent(post.slug)}` : '/berita',
      gambar: post.cover_image || ''
    };
  }

  function postToListItem(post) {
    return {
      id: post.id,
      judul: post.title,
      tanggal: toDateOnly(post.published_at || post.updated_at),
      ringkasan: post.summary || post.content || '',
      kategori: post.category || ''
    };
  }

  function postToNewsWidget(post, index = 0) {
    const tones = [
      ['#0f2640', '#d71920'],
      ['#183b56', '#d6a243'],
      ['#0f4c81', '#18a999'],
      ['#7a1f1f', '#f59e0b']
    ];

    return {
      id: post.id,
      title: post.title,
      summary: post.summary || post.content || '',
      content: post.content || '',
      category: post.category || 'Berita',
      date: toDateOnly(post.published_at || post.updated_at),
      readTime: '2 menit',
      image: post.cover_image || '',
      url: post.slug ? `/berita/${encodeURIComponent(post.slug)}` : '/berita',
      imageTone: tones[index % tones.length],
      isHeadline: index < 3,
      isBreaking: index < 2,
      views: 0
    };
  }

  async function fetchPosts(type, limit = 12) {
    const params = new URLSearchParams({ type, limit: String(limit) });
    return fetchJson(`${endpoints.posts}?${params.toString()}`);
  }

  async function fetchSettings() {
    return fetchJson(endpoints.settings);
  }

  async function getSettingsMap() {
    const rows = await fetchSettings();
    if (!rows) return null;

    return rows.reduce((settings, row) => {
      if (row?.key) settings[String(row.key)] = row.value == null ? '' : String(row.value);
      return settings;
    }, {});
  }

  async function fetchPpidDocuments() {
    return fetchJson(endpoints.ppidDocuments);
  }

  async function getPpidDocuments() {
    const documents = await fetchPpidDocuments();
    if (!documents) return null;

    return documents.map((document) => ({
      id: String(document.id),
      title: document.title,
      category: document.category,
      year: String(document.document_year || ''),
      format: document.file_format || 'PDF',
      size: document.file_size || '-',
      updatedAt: toDateOnly(document.published_at || document.updated_at),
      description: document.description || '',
      source: document.source === 'local' ? 'Penyimpanan BPAD' : 'Tautan eksternal',
      url: document.file_url || document.external_url || document.preview_url || '#dokumen-belum-tersedia'
    }));
  }

  async function getBerita(limit = 12) {
    const posts = await fetchPosts('berita', limit);
    return posts ? posts.map(postToBerita) : null;
  }

  async function getPengumuman(limit = 10) {
    const posts = await fetchPosts('pengumuman', limit);
    return posts ? posts.map(postToListItem) : null;
  }

  async function getAgenda(limit = 10) {
    const posts = await fetchPosts('agenda', limit);
    return posts ? posts.map(postToListItem) : null;
  }

  async function getNewsWidgetItems(limit = 12) {
    const posts = await fetchPosts('berita', limit);
    return posts ? posts.map(postToNewsWidget) : null;
  }

  window.BPADPublicData = {
    enabled: true,
    fetchPosts,
    fetchSettings,
    fetchPpidDocuments,
    getSettingsMap,
    getPpidDocuments,
    getBerita,
    getPengumuman,
    getAgenda,
    getNewsWidgetItems
  };
})();
