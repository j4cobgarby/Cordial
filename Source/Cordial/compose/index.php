<?php require '../phpneed.php'; ?>

<!DOCTYPE html>

<!-- COMPOSE -->

<html>
  <head>
    <?php require '../sublogincheck.php'; ?>

    <meta charset="utf-8">
    <title>Compose</title>
    <link rel="stylesheet" href="../styles/homepage.css">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="../styles/compose.css">
    <script src="../scripts/script.js" charset="utf-8"></script>
    <script src="../showdown.min.js" charset="utf-8"></script>
    <script src="../showdown-table.min.js" charset="utf-8"></script>
  </head>
  <body>
    <?php require '../subheader.php'; ?>

    <div class="compose-form-wrapper">
      <form class="makepost" action="sendpost.php" method="post">

         <h2>New post</h2>

         <span class="req">*</span>
         <span>Title</span><br />
         <input placeholder="Title" maxlength="65" type="text" name="title" required /><br /><br />

         <span class="req">*</span>
         <span>Content
           <img onclick="window.location.href='https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet'" title="Styling with markdown is supported" class="md hoverpointer" src="../assets/md.png" />
         </span><br />
         <textarea id="content" maxlength="5500" placeholder="Content" name="content" required ></textarea><br /><br />

           <span class="req">*</span>
           <span>Category</span>
           <select name="category" required>
             <option disabled selected value>Choose a category</option>
             <option value="swar">Software</option>
             <option value="hwar">Hardware</option>
             <option value="gdev">Game Dev</option>
             <option value="wdev">Web Dev</option>
             <option  value="sci">Science</option>
             <option value="meme">Memes</option>
             <option value="pics">Photography</option>
             <option value="pols">Politics</option>
             <option value="rand">Random</option>
             <option value="meta">Meta</option>
           </select>

         <br />

         <input type="submit" name="sendpost" value="Post!" />
      </form>
    </div>

    <div class="compose-preview-wrapper">
      <h1>Markdown Preview</h1>
      <hr>
      <div id="preview">
        The Markdown preview will be here
      </div>
      <script>
        var converter = new showdown.Converter({extensions: ['table']});
        setInterval(function() {
          if (document.getElementById('content').value != '') {
            document.getElementById('preview').innerHTML = converter.makeHtml(document.getElementById('content').value);
          } else {
            document.getElementById('preview').innerHTML = '<span class="nocontent">Your post will be previewed here, so that if you choose to use Markdown you don\'t have to worry whether or not it\'ll look how you expect.</span>';
          }
        }, 20);
      </script>
    </div>
  </body>
</html>
