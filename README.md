[b]I am writing the module v0.9.8 could someone also test it v0.9.7[/b]

[url=http://arshaw.com/fullcalendar/]You Can Use This Plug-In For Calendar View[/url]

[b]Features[/b]
- Multi Language Support
- (Colored) Category Support (thnx @Beninho for idea)
[b]Planning[/b]
- Article Support (Whats this mean? You could attach an event to an article) Just Planning!

[b]Changes :[/b]
- All codes optimized
- url deleted from module table
- url added to module lang table
- lots of cleanup
- Category Support added
- List display better
- many more little things!

[b]Some Screenshots About Module(New Screenshots!)[/b]
[img]http://i46.tinypic.com/30tqb0w.jpg[/img]
[url=http://i46.tinypic.com/23w5qjd.png]Event Calendar Main Windows[/url]
[url=http://i48.tinypic.com/ir4wuw.png]Event Calendar Main Window List View[/url]
[url=http://i47.tinypic.com/2wdo681.png]Event Calendar Main Window Edit Event[/url]
[url=http://i48.tinypic.com/w81e0m.png]Categories Main Window[/url]
[url=http://i50.tinypic.com/5ogr2f.png]Categories Main Window Edit Category[/url]
[url=http://i46.tinypic.com/15gz8e1.png]JSON Example View[/url]
[url=http://i49.tinypic.com/2qjdqmc.png]Example With <ion:tags />[/url]
[url=http://i49.tinypic.com/iyiu0j.png]Example With <ion:tags /> hover effect (thnx @Beninho)[/url]


[b]AVILABLE IONIZE CMS TAGS :[/b]

[b]Count All Events :[/b]
[code]
<ion:eventcalendar:count_all />
[/code]

[b]Listing Events :[/b]
[code]
<ion:eventcalendar:events>
     <ion:id_event /> 
     <ion:name />
     <ion:title />
     <ion:subtitle />
     <ion:description />
     <ion:url />
     <ion:start_date />
     <ion:end_date />
     <ion:author />
     <ion:updater />
     <ion:created />
     <ion:updated />
     <ion:event_id_category />
     <ion:event_id_article />
     <ion:event_category_title />
     <ion:event_category_subtitle />
     <ion:event_category_description />
     <ion:event_category_name />
     <ion:event_category_color />
</ion:eventcalendar:events>
[/code]

[b]Listing Categories : [/b]
[code]
<ion:eventcalendar:categories>
    <ion:id_category />
    <ion:category_title />
    <ion:category_subtitle />
    <ion:category_description />
    <ion:category_name />
    <ion:category_color />
 </ion:eventcalendar:categories>
[/code]