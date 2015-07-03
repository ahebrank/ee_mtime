# ee_mtime

A super simple plugin for cache-busting by file modification time.

For example:

```
<link rel="stylesheet" href="/css/main.css?v={exp:ee_mtime path='css/main.css'}">
```

The file is specified as an absolute or relative (to webroot) path.