function tryLike(id) {
  console.log("Trying to like post "+id);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Logic, using this.responseText
      var likeCount = document.getElementById('like-count');
      var likeIcon = document.getElementById('like-icon');

      if (this.responseText == 'true') {
        // The post could be liked, and was
        likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
        likeIcon.src = '../assets/like-icon.svg';
      } else {
        // The post couldn't be liked
        likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
        likeIcon.src = '../assets/like-icon-greyed.svg';
      }
    }
  };
  xhttp.open("POST", "like_post.php?id="+id, true);
  xhttp.send();
}

function tryLikeComment(id) {
  console.log("Trying to like comment "+id);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Logic, using this.responseText
      var likeCount = document.getElementById('like-count-'+id);
      var likeIcon = document.getElementById('like-img-'+id);

      if (this.responseText == 'true') {
        // The post could be liked, and was
        likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
        likeIcon.src = '../assets/like-icon.svg';
      } else {
        // The post couldn't be liked
        likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
        likeIcon.src = '../assets/like-icon-greyed.svg';
      }
    }
  };
  xhttp.open("POST", "like_comment.php?id="+id, true);
  xhttp.send();
}
