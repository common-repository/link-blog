=== Link Blog ===
Contributors: miltonbjones
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W3EG6DW6Y3JRU
Tags: link blog, linkblog, link post, tumblog, tumblelog, tumblr
Requires at least: 3.4
Tested up to: 4.4
Stable tag: 1.2
License: GPLv2

Allows you to create a simple link blog with WordPress.

== Description ==

There are many ways to make a link blog, and many ways to do it with WordPress other than using this plugin, but I made this plugin to do it a certain way that I think is pretty easy to deal with.


== Installation ==

1. Upload the *link-blog* folder to your `/wp-content/plugins/` directory
1. Activate the plugin through the *Plugins* menu in WordPress
1. Place `<?php if (function_exists('mbj_link_blog_link_url_display')) { mbj_link_blog_link_url_display(); } ?>` in all the places you want to link to the external URL you are writing about rather than the internal permalink.  Typically this will be in the link markup that surrounds the title of a post on your blog index page, replacing `<?php the_permalink(); ?>`.

== Frequently Asked Questions ==

= What is a link blog and how does this plugin help me make one? =

When you think about a standard blog, you'll typically have an index page with a bunch of posts listed in reverse chronological order.  That index page might have 3, 5, 10 posts on it, who knows.  If you want to see just one article, you normally can click on the title of the post to get there.  Then if you want to send somebody a link to just that post, you can send them the link to that URL, since it shows that one single post only.  That link is called a permalink.  That's pretty much a standard term, and it's the terminology used in WordPress.  In fact, `the_permalink()` is the WordPress function that echoes that URL for a given post.

Most of the time that is fine and good, but a link blog is a little different.  Link blogs typically are designed around finding interesting web pages (articles, websites, resources, etc.), perhaps showing a quick excerpt from the page, making a comment about it, and then providing a link to the mentioned web page.  The standard format of a link blog is to have the title of the post on the index page link *to the external website being discussed* rather than to the internal permalink for the blog post on the link blog.

This plugin (Link Blog) makes it easy for you to create a link blog with WordPress while letting you maintain control over where you place the external link URL and where you place your internal permalink.

= How does the plugin work? =

Basically the plugin adds a meta box to your *Edit Post* screen that allows you to add a link URL to each blog post you write.  The meta box has a heading of *Link Blog Info* and it has one field labeled *URL to link to:*, which is where you'll type in the external URL you want to link to.

The plugin also provides a function (or template tag) for echoing that link URL in your theme wherever you want it.  I know that involves getting into the code, which some people aren't comfortable with, but a lot of people who want link blogs still want to also use a permalink for each post on the index page too, so I didn't want to make the external link URL just replace all the permalinks on your blog.  This way, you can do something like put the external link URL template tag around the title of your post, and still have something like "Posted on October 12" formatted as a link to the permalink, `the_permalink()`.

= What if I want some posts to link to external sites and some posts to link to the internal permalink? =

If you want your blog to be a hybrid that includes some link posts (linking to external sites) and some traditional posts (linking to internal permalinks), you can do that with this plugin.  All you have to do is leave the *URL to link to:* field blank and that particular post will still link to the standard permalink.


== Changelog ==

= 1.0 =
* Plugin Launched

= 1.1 =
* Fixed an error with settings page; basically there shouldn't have been a settings page in the first place and that was the problem

= 1.2 =
* Added support for having some posts be link posts and other posts still link to internal permalink
