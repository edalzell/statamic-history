# Requirements

* History uses a local SQLite db, so please ensure your PHP installation has [SQLite support](https://secure.php.net/manual/en/book.sqlite.php)

# Installation

1. Copy addon to `addon` folder
2. From the command line, `php please history:install`

# Usage

When any Global, Entry or Page is saved, the details are recorded.

You can the history by adding one or more `history` widgets to your dashboard:

```
widgets:
  -
    type: history
    width: full
    title: Most Recent Changes
    limit: 5
    date_format: M j, g:i a
    current_user: true
    all_events: false
```

`title` - optional, defaults to `"Most Recent Changes"`
`limit` - optional, defaults to `5`
`date_format` - optional, defaults to your CP date format
`current_user` optional, defaults to false. If `true` only shows **your** changes
`all_events` - optional, defaults to `true`. If false, only the latest change for each content type are shown. For example, if someone made 5 changes to a page, only the latest would be shown.
