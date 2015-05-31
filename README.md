# Drupal NgBeans
NgBeans is inspired from work I've been doing with integrating Drupal with 
Angular. As the name suggests, it's based on the Drupal 
<a href="https://www.drupal.org/project/bean" target="_blank">Bean</a> module.

What I like about Bean is it's versatility. A Bean is not a block or node.
Bean is it's own entity and all the goodness that comes with it. Like, setting
permissions on a specific Bean. A Bean can be displayed as a block so you can 
add it wherever you display a block.

There are two versions of this project. You'll find each under it's
appropriate tag in this repo.

- Version 1 Branch (7.x-1.x): Very simple but functional module to allow a user to copy
and paste markup and Javascript into a Bean then display this "widget" as a block
on any page.
- Version 2 Branch (7.x-2.x): While trying to keep simplicity in mind, this 
branch allows more flexibility in using Angular within Drupal. This is where
the bulk of the work for this module happens.

## Dependencies
The module depends upon the following:

- PHP >=5.3
- <a href="https://www.drupal.org/project/libraries" target="_blank">Libraries</a>
- <a href="https://www.drupal.org/project/bean" target="_blank">Bean<a/>
- <a href="https://www.drupal.org/project/ace_editor" target="_blank">Ace Editor</a> (optional)

## Installation

### Clone the module
**While this module is listed under drupal-ngbeans, the module name is ngbeans.**
Below is an example of the checkout (*nix based). Replace `NGBEANS_INSTALL_PATH` 
and `NGBEANS_BRANCH` with your specific values. 
You don't have to use environmental variables. I only use them for clarity.

```bash
export NGBEANS_INSTALL_PATH="sites/all/modules/contrib/ngbeans"
export NGBEANS_BRANCH="7.x-1.x"
mkdir $NGBEANS_INSTALL_PATH
cd $NGBEANS_INSTALL_PATH
# git >=1.7.10
git clone https://github.com/rojosnow/drupal-ngbeans.git --branch $NGBEANS_BRANCH .
```

### Install the Angular library
1. Download the zip version of the Angular 1.3.15 library from the 
<a href="https://angularjs.org" target="_blank">downloads</a>.
2. Uncompress the zip file.
3. Under `sites/all/libraries`, create an angular folder. Within the angular folder,
copy in **only the .js and .min.js** Angular library files.
4. You don't need to copy in the `angular-scenario.js` or `angular-mocks.js` files
are they are not used.
5. PLEASE NOTE that the NgBeans module declares the Angular library (`hook_library`) and this 
may or may not work for your situation if you've declared the Angular library
elsewhere.

### Install Ace Editor (optional)
I like working in an IDE-like environment even on websites. I use the Drupal
<a href="https://www.drupal.org/project/ace_editor" target="_blank">Ace Editor</a> 
module to do this. It's entirely optional but recommended...although there are some
setup quirks and a patch that might need to be applied depending upon your 
version of jQuery.

Installation instructions are found above and not covered here.

### Enable the module
Use your favorite method to enable the NgBeans module.

### Set your permissions
Make sure to set permissions (`admin/people/permissions`) on the Bean module. 
You might look to find this under the NgBeans module. It isn't. NgBeans is 
like a "content type" but for a Bean and not a node. Look at the permissions
under Bean. It should make more sense once you see it. By default, the administrator has full
permissions. You'll need to change these settings.

## Using NgBeans
Under `admin/structure/block-types`, you'll see a Bean called NgBeans App. This has
been created by the NgBeans module. Feel free to add additional fields if needed.

Under `block/add/ngbeans-app`, create your first NgBeans Angular application.

1. Enter a Label.
2. Enter a Title.
3. Check which Angular libraries/resources your application will use. The module automatically
loads angular.js
4. Enter or paste your markup into the NG Markup field. This is your Angular application.
It should be all your code from the ng-app directive and below.
5. Enter or paste your Angular Javascript code into the NG Code field. Do not use
script tags. If you have multiple files, you will need to combine your code.
6. Save your NgBean. The page will refresh and will be be displayed on the page.
7. To place your NgBean in a region, go to `admin/structure/block` and find your
NgBean. Add it to a region like any other normal block.

**Example**

- Label: Sample NG Application
- Title: NG Demo App
- No Angular boxes need to be checked.
- Enter the following into NG Markup<br>
```html
<div ng-app="demo">
  <span>Enter text:</span>
  <input type="text" ng-model="data.message">
  <h1>{{data.message}}</h1>
</div>
```
- Enter the following into NG Code<br>
```Javascript
angular.module('demo', []);
```
- Save your NgBean.

On the page displayed, the text you entered will be displayed below the text 
box. Congrats! You've made your first Angular application with Drupal.

**Note on "blocks"**

I realize the use of the word "block" is confusing since blocks now refer to
Drupal core blocks and Bean blocks. You'll see Block menu options under
`admin/content` and `admin/structure`. And, there is a new Blocks tab under `admin/content`.
Take a few moments to get familiar with the new menus Bean has added.

Enjoy!

## Author
Robert Jordan (rojosnow) - robert@jordanjr.com


## Credits
Development of this module was sponsored by 
<a href="https://www.rallydev.com" target="_blank">Rally</a>, a 
leading agile and business agility software and services provider.

Inspiration and code from Jitesh Doshi's 
sandbox: <a href="https://www.drupal.org/sandbox/jitesh_doshi/2125941" target="_blank">restng</a>
