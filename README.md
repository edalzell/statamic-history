# History

See who changed what content (Global, Entry, Page) when:

* in your dashboard
* as a full list
* in a template

You can filter the widgets to only show **your** changes, and/or to show only the updates per content.

Front end:
```
{{ history :id="content_id" }}
    <p>Last modified by {{ user :id="user_id" }}{{ first_name }}{{ /user }} on {{ last_modified }}</p>
{{ /history }}
```
