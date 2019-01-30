<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($categories as $category)
    @foreach($category->pages as $page)
    <url>
      <loc>{{ $category->slug == 'blog' ? route('post', $page->slug) : route('page', $page->slug) }}</loc>
      <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
      <priority>{{ $category->slug == 'blog' ? '0.6' : '0.2' }}</priority>
    </url>
    @endforeach
  @endforeach
  @foreach($books as $book)
  <url>
    <loc>{{ route('book', $book->slug) }}</loc>
    <lastmod>{{ $book->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    <priority>1</priority>
  </url>
  @endforeach
  @foreach($publishers as $publisher)
  <url>
    <loc>{{ route('publisher', $publisher->slug) }}</loc>
    <lastmod>{{ $publisher->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    <priority>0.7</priority>
  </url>
  @endforeach
  @foreach($authors as $author)
  <url>
    <loc>{{ route('author', $author->slug) }}</loc>
    <lastmod>{{ $author->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    <priority>0.7</priority>
  </url>
  @endforeach
</urlset>
