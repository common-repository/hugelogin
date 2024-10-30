=== HugeLogin ===
Contributors: hugelogin
Donate link: https://www.hugelogin.com
Tags: security, passwordless login, login, front-end login, login shortcode, custom login form, login without password, passwordless authentication
Requires at least: 3.0.1
Tested up to: 5.8.3
Stable tag: 3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Just enter your email, and HugeLogin will send you a verification request. Its that simple. To disconnect, logout or use the HugeLogin app.

== Description ==

Too much time and effort goes into creating passwords, forgetting passwords, retrieving passwords, and storing passwords for thousands of apps that we use everyday.  At HugeLogin, we are building a single secure platform to stop this problem.

There are more mobile devices than desktop computers.  Securely manage all of your app accounts, and authenticate with our partner applications.

With simplicity in mind, we've thought about how you want to manage your accounts.  Easy to find, easy to update, and easy to disconnect.

This is how it works:

* Instead of asking users for a password when they try to log in to your website, we simply ask them for their email
* Then we send the user an email with a link and the token
* The user clicks the link and sends the authorization code back to the Wordpress site
* The plugin then checks if the code is valid and creates the login to WordPress, successfuly authenticating the user.

== Installation ==

It is extremely easy to install the HugeLogin WordPress plugin:

1. Upload the plugin .zip file using the 'Plugins' menu in WordPress.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add your HugeLogin API token under the new HugeLogin menu after the plugin has been activated.  Go to https://www.hugelogin.com to request a token.
4. Configure whether you want to use the default WordPress login, HugeLogin, or both.

== Frequently Asked Questions ==

= The plugin isn't working, who can I talk to about it? =

	Contact admin@hugelogin.com for any support questions.  We are always improving this plugin.

= Couldn't anyone login if they have that link? =

	The token expires after 10 minutes and can only be used once. If people have access to that link it's supposed they have access to your email, in which case it's as safe as the default login, since they could reset their passwords.

= Isn't it more complicated they just entering a password? =

	Weak passwords are used every day by users. There are also people who user the same password across various services and websites. By using the Passwordless Login plugin your users will have one less password to worry about.

= But what if my users don't want to login every time via their email?  =

	You can extend the auth cookie expiration to something like 1 month or 3 months. (currently only possible via code; will be available in a future version). Also, you can offer Passwordless Login as an alternative login system and enforce stronger passwords on registration using <a href="http://wordpress.org/plugins/profile-builder/">Profile Builder plugin.</a>
  

== Screenshots ==

1. The HugeLogin form alongside of the default WordPress login form.
2. The list of accounts from within the HugeLogin app.
3. The Activity history from within the HugeLogin app.

== Changelog ==

= 0.5 =
* The initial release of the plugin.

== Upgrade Notice ==

No upgrades yet

== Features ==

* Any user who logs in with HugeLogin can manage their accounts with the HugeLogin app.  They can also login and logout from your site from the app.
* Increase signup conversion on your site with a single signin field (email address).
* When you signup for a token as a provider, you will be listed as a provider from the HugeLogin app.
* The HugeLogin app also keeps track of the history and location of the user's activity on your site.

== Future Features ==

* Send messages to users in the HugeLogin app, creating another channel for engagement
* Biometric fingerprint login
* SMS code login
* One-click payments via stored payment types in the HugeLogin app
* Usage statistics

More information located at [HugeLogin](https://www.hugelogin.com "The beginning of the end for passwords.") 
