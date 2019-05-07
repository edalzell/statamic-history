# Requirements

* History uses a local SQLite db, so please ensure your PHP installation has [SQLite support](https://secure.php.net/manual/en/book.sqlite.php)

# Installation

1. Copy addon to `addon` folder
2. From the command line, `php please history:install`

# Usage

When any Global, Entry, or Page is saved, the details are recorded.

## Tags

By default, the {{ history }} tag will output all events that have been recorded for a Global, Entry, or Page. This can be really useful for when you need to output a log of changes made to a particular piece of content.

You can display the last modified date for all content, regardless of content order (i.e. non-date collections).

```
<ul>
    {{ history id="content_id" }}
        <li>Modified by {{ user :id="user_id" }}{{ first_name }}{{ /user }} on {{ last_modified }}</li>
    {{ /history }}
</ul>
```

But what happens if you just want to output the latest, or earliest change made to a piece of content? We'll, we've got you covered there too!

### Latest

Let's say you want to output the last time a particular page was updated. It's as easy as typing (or copy and pasting):

```
{{ history:latest id="content_id" }}
    <li>Last modified by {{ user :id="user_id" }}{{ first_name }}{{ /user }} on {{ last_modified }}</li>
{{ /history:latest }}
```

### Earliest

We're not sure why this would be useful, but hey, whatever. We've given you the ability to use it anyway. As you might have guessed, it lets you output the first time a piece of content was edited after being saved.

```
{{ history:earliest id="content_id" }}
    <li>First modified by {{ user :id="user_id" }}{{ first_name }}{{ /user }} on {{ last_modified }}</li>
{{ /history:earliest }}
```

### Parameters

* `id` - id of the content

It's worth noting that you can set this up in two different ways.

#### For the current page

If you want to show when the last edit to the page you're editing was, you can 'bind' the id to the context. All this means is that instead of needing to manually edit the id, or set up a custom field, you can write `:id="id"` and it'll read the id of the current page. It'll look like this:

```
{{ history:latest :id="id" }}
    <li>Last updated by {{ user :id="user_id" }}{{ first_name }}{{ /user }} on {{ last_modified }}</li>
{{ /history:latest }}
```

_If you look carefully, you'll notice we're using the same trick for grabbing the user that edited the content._

#### For another piece of content

Let's say you have a global that has a list of shareholders. When that's updated, you have to legally note when it was last updated. This is a manual job, and let's face it, people are lazy, so they'll probably forget one time. And let's face it, that one time is going to be when the regulator looks. Sods law, eh?

Anyway, luckily you can automate that using this swanky addon. To do so, on the page where you output the list of shareholders, simply reference the id of the global in the history tag. It'll look something like this:

```
{{ history:latest id="id_of_global" }}
    <li>Last modified on {{ last_modified }}</li>
{{ /history:latest }}
```

### Variables

* `user_id` - id of the user that last updated the content
* `last_modified` - timestamp of the last modification

If you want to get fancy, you can also edit the `last_modified` variable with other modifiers like [Format](https://docs.statamic.com/modifiers/format), and [Days Ago](https://docs.statamic.com/modifiers/days_ago). Cool, right!?

## Widgets

You can show the history by adding one or more `history` widgets to your dashboard:

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

* `title` - optional, defaults to `"Most Recent Changes"`
* `limit` - optional, defaults to `5`
* `date_format` - optional, defaults to your CP date format
* `current_user` optional, defaults to false. If `true` only shows **your** changes
* `all_events` - optional, defaults to `true`. If false, only the latest change for each content type are shown. For example, if someone made 5 changes to a page, only the latest would be shown.
