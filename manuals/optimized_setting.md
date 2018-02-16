# Оптимизация загрузки сайта

1. Отдавать статический контент без куков
http://www.xpertdeveloper.com/2011/07/wordpress-cookie-free-domain/

wp-config.php
```php
  define("WP_CONTENT_URL", "http://static.yourdomain.com");
  define("COOKIE_DOMAIN", "www.yourdomain.com");
```

2. Настройки кеширования контента

.htaccess
```
  <IfModule mod_expires.c>
   ExpiresActive on
   
  # Perhaps better to whitelist expires rules? Perhaps.
   ExpiresDefault "access plus 1 month"
   
  # cache.appcache needs re-requests
  # in FF 3.6 (thx Remy ~Introducing HTML5)
   ExpiresByType text/cache-manifest "access plus 0 seconds"
   
  # Your document html
   ExpiresByType text/html "access plus 0 seconds"
   
  # Data
   ExpiresByType text/xml "access plus 0 seconds"
   ExpiresByType application/xml "access plus 0 seconds"
   ExpiresByType application/json "access plus 0 seconds"
   
  # RSS feed
   ExpiresByType application/rss+xml "access plus 1 hour"
   
  # Favicon (cannot be renamed)
   ExpiresByType image/x-icon "access plus 1 week"
   
  # Media: images, video, audio
   ExpiresByType image/gif "access plus 1 month"
   ExpiresByType image/png "access plus 1 month"
   ExpiresByType image/jpg "access plus 1 month"
   ExpiresByType image/jpeg "access plus 1 month"
   ExpiresByType video/ogg "access plus 1 month"
   ExpiresByType audio/ogg "access plus 1 month"
   ExpiresByType video/mp4 "access plus 1 month"
   ExpiresByType video/webm "access plus 1 month"
   
  # HTC files (css3pie)
   ExpiresByType text/x-component "access plus 1 month"
   
  # Webfonts
   ExpiresByType font/truetype "access plus 1 month"
   ExpiresByType font/opentype "access plus 1 month"
   ExpiresByType application/x-font-woff "access plus 1 month"
   ExpiresByType image/svg+xml "access plus 1 month"
   ExpiresByType application/vnd.ms-fontobject "access plus 1 month"
   
  # CSS and JavaScript
   ExpiresByType text/css "access plus 1 year"
   ExpiresByType application/javascript "access plus 1 year"
   ExpiresByType text/javascript "access plus 1 year"
   
    <IfModule mod_headers.c>
      Header append Cache-Control "public"
    </IfModule>
  </IfModule>
```

3. Объявите константу для наиболее часто используемых значений в базе данных

wp-config.php
```php
  define('MY_HOME','http://www.yourdomain.com');
  define('BLOG_NAME','Expert Developer');
```

4. Оптимизировать БД установкой плагина

Yoast Optimize DB
WP DB manager

5. Кешируй контент плагинами

WP Super Cache
Hyper Cache
W3 Total Cache

6. Кешируй запросы базы плагином 

DB Cache

7. Используйте CDN для сайтов с высокой посещаемостью

Amazon S3
Max CDN
Media Temple CDN
Free CDN

8. Сжатие и сочетание JS и CSS файлов

9. Оптимизация изображений

WP Smush IT

10. Использование спрайтов

11. Сжатие вашего статичного контента с помощью gZip

.htaccess 
```
  <IfModule mod_deflate.c>
   # force deflate for mangled headers
   # developer.yahoo.com/blogs/ydn/posts/2010/12/pushing-beyond-gzipping/
   <IfModule mod_setenvif.c>
   <IfModule mod_headers.c>
   SetEnvIfNoCase ^(Accept-EncodXng|X-cept-Encoding|X{15}|~{15}|-{15})$ ^((gzip|deflate)\s*,?\s*)+|[X~-]{4,13}$ HAVE_Accept-Encoding
   RequestHeader append Accept-Encoding "gzip,deflate" env=HAVE_Accept-Encoding
   </IfModule>
   </IfModule>
   
  # HTML, TXT, CSS, JavaScript, JSON, XML, HTC:
   <IfModule filter_module>
   FilterDeclare COMPRESS
   FilterProvider COMPRESS DEFLATE resp=Content-Type $text/html
   FilterProvider COMPRESS DEFLATE resp=Content-Type $text/css
   FilterProvider COMPRESS DEFLATE resp=Content-Type $text/plain
   FilterProvider COMPRESS DEFLATE resp=Content-Type $text/xml
   FilterProvider COMPRESS DEFLATE resp=Content-Type $text/x-component
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/javascript
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/json
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/xml
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/xhtml+xml
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/rss+xml
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/atom+xml
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/vnd.ms-fontobject
   FilterProvider COMPRESS DEFLATE resp=Content-Type $image/svg+xml
   FilterProvider COMPRESS DEFLATE resp=Content-Type $application/x-font-ttf
   FilterProvider COMPRESS DEFLATE resp=Content-Type $font/opentype
   FilterChain COMPRESS
   FilterProtocol COMPRESS DEFLATE change=yes;byteranges=no
   </IfModule>
   
  <IfModule !mod_filter.c>
   # Legacy versions of Apache
   AddOutputFilterByType DEFLATE text/html text/plain text/css application/json
   AddOutputFilterByType DEFLATE application/javascript
   AddOutputFilterByType DEFLATE text/xml application/xml text/x-component
   AddOutputFilterByType DEFLATE application/xhtml+xml application/rss+xml application/atom+xml
   AddOutputFilterByType DEFLATE image/svg+xml application/vnd.ms-fontobject application/x-font-ttf font/opentype
   </IfModule>
   </IfModule>
```
