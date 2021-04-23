# wordpress-archive-pages
This is an exploration into how archive pages could tie in better into editable areas in WordPress. Like the Post Page

## The Problem Currently:
In many projects I have been involved with I have seen the need from design / clients to have more controll over archive pages. This gets resolved by either creating a page template that replaces the archive page, or by creating a Custom Post Type called "Acive Pages" that allows editors to create pages where they can manage the content of the archive page. 

To me these solutions are very brittle though. Page templates can be used more than once and make it very difficult to have an actuall back to archive link for example. So the whole permalink structure is kind of broken. The same goes for custom post tyoes. 

## Idea:
In WordPress core there is a toggle in the settings and in the cusomizer to chose what page should get used as the blog page. So it therefore allows editors to choose the permalink and heading of a Post type archive page. I would like to see that feature extended so that any CPT can opt into it. So editors can chose a page that they habe created and named as the archive page. 
This would allow editors to have more controll over Archive pages and for example set meta values, change the permalink. This then also allows theme developers to add more capabilities to archive pages. By default the editor would be dissabled like it is of the blog page, but in theory archives could make use of that content and add it above / beneath the content. Or use a featured image for a header. 

In the admin this would also add some text after the page title in the post table like the blog page or privacy page do.
