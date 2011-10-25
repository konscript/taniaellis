=== Quick Subscribe ===
Contributors: LeoGermani
Donate link: http://pirex.com.br/wordpress-plugins
Tags: subscribe, subscribers, register, registration, mailing, email
Requires at least: 2.2
Tested up to: 2.5
Stable tag: 1.7.1

Allows visitors to quickly subscribe to your blog using only an email address

== Description ==

Allows visitors to quickly subscribe to your blog using only an email address.

The widget will present a text field where the visitor will enter an email address. No email confirmation is sent to the visitor, a user name based on the email address (the email without the @) is created and the password is randomly generated.

This is perfect if you want your readers to easily subscribe to your blog without the need of having an username and password. The ideia is to use the list of subscribers as a mailing to send news, updates or whatever you want to send to your readers.

You can use it together with plugins such as Subcscribe2 and WPMailing

== Installation ==

. Download the package
. Extract it to the "plugins" folder of your wordpress
. In the Admin Panes go to "Plugins" and activate it
. Go to Presentation > Widgets and set it up

== Usage ==

There are three ways to insert the quick subscribe form:

1. Widget: Go to you widgets page and activate the Quick Subscribe Widget

2. Inside a post or page: Type [quicksubscribe] inside a post or page to display the form

3. Template tag: insert the code <?php quick_subscribe_form(); ?> anywhere in your template

Go to Options > Quick Subscribe to change some options for this form.


== ChangeLog ==

1.1 (01/21/2008)
. Added options to choose wether to display a submit button or not

1.5 (01/21/2008)
. add form to page or post usgin [quicksubscribe] tag
. added options page for post/page form

1.6 (03/15/2008)
. changed the form's action from "#" to the curent URL
. fixed bug that would not display Thanks message on widgets properly

1.7 (20/052008)
. now you can add the form using the template tag <?php quick_subscribe_form(); ?>

1.7.1 (23/05/2008)
. Fixed bug that would not display Thanks message properly. AGAIN!
