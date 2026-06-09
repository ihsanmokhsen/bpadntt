<aside class="operator-guide">
    <div>
        <span class="operator-guide-label">Panduan Operator</span>
        <strong>{{ $title }}</strong>
    </div>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</aside>
