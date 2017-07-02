[![Cordial](https://github.com/j4cobgarby/Cordial/blob/master/cordial-onred.png)](http://cordial.jacobgarby.co.uk)

[![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/uses-html.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/uses-js.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/uses-css.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/contains-cat-gifs.svg)](http://forthebadge.com)
![XAMPP](https://d16zszyyqlzz6z.cloudfront.net/images/stamps/stamp-173x38-f087cb4d.gif)
![Hosted on 1&1](https://pbs.twimg.com/profile_images/878153593467097088/beLm2vCz_normal.jpg)

# Status

**Development finished (for now!)**
Usable; all main features work. Now the priority is to fix many, many small bugs.

# History

I first started developing Cordial, or at least something called Cordial, about 10 months ago, when I wasn't too great at web development and had no real concept of how I would actually make a social network. I attempted it nevertheless, and my attempt can be found at my repository *Cordial-old*.

However ~~a few weeks ago~~ I bought a domain: http://jacobgarby.co.uk. This came with a hefty 100GB of storage and, more importantly, 25 1GB databases! So I thought hey, why don't I use one of these to remake Cordial? So after making a design, I decided it wasn't very good, and designed another one. About 5 or 6 designs later, I'd came up with what the header would look like. The same goes for the other aspects.

Anyway, after learning PHP to a reasonable degree and getting the hang of MySQL queries, I had a working version of Cordial. This was before it was on GitHub I believe. At this point, it read users and posts from a relational database I'd set up.

Between then and now, I've changed the structure of the database at least 5 times.

Anyway..

I got most of the inspiration for Cordial from a mix of Reddit, 4chan, and Twitter. I also drew all of the icons and assets myself, in case you were wondering.

## The awesome logo

I came up with so many designs for the logo, I can't even remember a lot of them. The first design I can remember, in fact, I didn't design and instead one of my friends did. If you can imagine it, it was basically the letter 'C' in the font 'Lobster' at a slight tilt on top of the base of a glass. The idea was that the 'C' looked like the cup of the glass.

Anyway, I decided not to use this logo now, since it just doesn't work well small, and is too intricate.

I tried a new design - black block capitals, where each letter has a different part of the spectrum as its background colour. It was okay, but not quite what I wanted.

Then I came back to the idea of [Cordial as being a kind of drink.](https://en.wikipedia.org/wiki/Cordial) I came up with the idea of having some kind of wavy pattern in the logo somewhere. I considered a few different designs, such as the word Cordial immersed in a wavy pool of blackness, and also the letters following a wavy curve, but settled on a design very similar to the current one - it was just the letter C, but filled up a bit with waves. This sort of worked, but just wasn't quite right. Quite soon after that, I came up with the final design. I was pretty pleased with this, since it looked good small (albeit much better bit,) and also was different to any other logo I've ever seen.

# How to use

## Locally (for development)

 1. Download and install XAMPP from [here](https://www.apachefriends.org/index.html). Make sure to install the Apache webserver *and* the MySQL server. You may install any of the other modules XAMPP offers, but you don't need them for this. If you already have XAMPP installed but don't have the required modules installed, you can always install them from the XAMPP Control Panel.
 
 2. Navigate to 'htdocs', which is in the directory in which XAMPP is installed. On Windows, this is by default 'C:\xampp'. On MacOS, it seems that there is no *default* location, but I don't have a Mac to test it on.
 
 3. Clone the repository into 'htdocs'.
 
 4. Now, open up the XAMPP Control Panel, and press 'Start' next to both the Apache and MySQL modules.
 
 5. In the XAMPP Control Panel, press the button labelled 'Admin' for the MySQL module. Given that MySQL is running, this should open up phpMyAdmin in a web browser. There will probably be some default databases, ignore those.
 
 6. Click 'Import' (on the top navigation bar,) and either drag in 'cordial.sql' or click 'Browse' and navigate to it.
 
 7. Click on the '+' symbol next to the newly created database named 'cordial' on the left hand side of the browser, to open up the tables. You should see a table names 'posts' and a table named 'users'. They both have some records in them - some fake users and posts. Notice it's a relational database - one user to many posts. If you want, you can delete these records.
 
 8. Create a new tab in your web browser and go [here](http://localhost/Cordial/Source/Cordial/) (localhost/Cordial/Source/Cordial.)
 
 9. **Done!**
 
*You will need internet connection even though it's local, since Cordial gets some fonts from Google fonts.*

## Live version

 1. [Click on this text](http://cordial.jacobgarby.co.uk).
 
 2. That's it.
 
# How to contribute

 1. Fork Cordial.
 
 2. Create a branch for your new feature.
 
 3. Commit to it. Use the local development instructions above for testing, etc.
 
 4. Push it!
 
# Stuff that needs doing

 - ~~Cleaning up the .less files a bit~~
 
 - ~~Being able to edit your bio from the user page~~
 
 - Being able to search for users
 
 - ~~Being able to like posts **only once**~~~
 
 - Fixing all the issues
 
# License

### GNU General Public License v3.0
