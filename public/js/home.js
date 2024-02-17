
fetch('api/fetch-posts', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
  })
    .then(response => response.json())
    .then(posts => {
      const feed = document.querySelector('.feed');
  
      posts.forEach(async post => {
        const postElement = document.createElement('div');
        postElement.classList.add('post');
  
         
        const removeButton = document.createElement('i');
        removeButton.classList.add('fas', 'fa-times', 'remove-button');
        removeButton.style.marginLeft = '98%';
        removeButton.style.cursor = 'pointer';
        postElement.appendChild(removeButton);
  
        
        removeButton.addEventListener('click', () => {
          removePost(post.id);
          postElement.remove();
        });
  
        const usernameElement = document.createElement('h3');
        usernameElement.textContent = post.username;
        postElement.appendChild(usernameElement);
  
        const contentElement = document.createElement('p');
        contentElement.textContent = post.post_content;
        postElement.appendChild(contentElement);
  
        if (post.post_image) {
          
          const isGif = post.post_image.includes('.gif');
  
          if (isGif) {
            const gifUrl = decodeURIComponent(post.post_image);
  
            const gifElement = document.createElement('img');
            gifElement.src = gifUrl;
            gifElement.setAttribute('autoplay', 'autoplay');
            gifElement.setAttribute('loop', 'loop');
            gifElement.classList.add('gif');
            postElement.appendChild(gifElement);
          } else {
            const imageElement = document.createElement('img');
            imageElement.src = post.post_image;
            postElement.appendChild(imageElement);
          }
        }
  
        
        const likeIcon = document.createElement('i');
        likeIcon.classList.add('fas', 'fa-thumbs-up', 'like-icon');
        likeIcon.style.cursor = 'pointer';
  
        
        let isLiked = await checkLike(post.id); 
  
        if (isLiked) {
          likeIcon.classList.add('liked');
        }
  
        
        likeIcon.addEventListener('click', () => {
          if (isLiked) {
            unlikePost(post.id, post.username);
            likeIcon.classList.remove('liked');
            isLiked = false;
          } else {
            likePost(post.id, post.username);
            likeIcon.classList.add('liked');
            isLiked = true;
          }
        });
  
        postElement.appendChild(likeIcon);
  
        
        const commentIcon = document.createElement('i');
        commentIcon.classList.add('fas', 'fa-comment');
        commentIcon.style.cursor = 'pointer';
        commentIcon.style.position = 'relative';
        commentIcon.style.top = '-15px';
        commentIcon.style.marginLeft = '25px';
  
        
        commentIcon.addEventListener('click', () => {
          
          const existingCommentInput = postElement.querySelector('.comment-input');
          if (existingCommentInput) {
            existingCommentInput.focus();
            return;
          }
  
          const commentInput = document.createElement('input');
          commentInput.classList.add('comment-input');
          commentInput.setAttribute('type', 'text');
          commentInput.setAttribute('placeholder', 'Enter your comment...');
          postElement.appendChild(commentInput);
  
          commentInput.addEventListener('keydown', event => {
            if (event.key === 'Enter') {
              const commentContent = commentInput.value.trim();
              if (commentContent) {
                submitComment(post.id, post.username, commentContent, postElement);
                commentInput.remove();
              }
            }

            
          });
        });
  
        postElement.appendChild(commentIcon);
 
        
        const timestampElement = document.createElement('span');
        timestampElement.textContent = post.created_at;
        timestampElement.style.marginLeft = '77%';
        postElement.appendChild(timestampElement);

       
  
        
        feed.appendChild(postElement);

        
        await fetchComments(post.id,postElement);


        

      });
    })
    .catch(error => {
      console.error('Error fetching posts:', error);
    });
  
  
  async function checkLike(postId) {
    try {
      const response = await fetch('api/check-like', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ postId }),
      });
  
      const data = await response.json();
      return data.liked;
    } catch (error) {
      console.error('Error checking like:', error);
      return false;
    }
  }
  
  
  async function likePost(postId, username) {
    try {
      const response = await fetch('api/like-post', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ postId }),
      });
  
      const data = await response.json();
      console.log('Post liked');
    } catch (error) {
      console.error('Error liking post:', error);
    }
  }
  
  
  async function unlikePost(postId, username) {
    try {
      const response = await fetch('api/unlike-post', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ postId }),
      });
  
      const data = await response.json();
      console.log('Post unliked');
    } catch (error) {
      console.error('Error unliking post:', error);
    }
  }
  
  
  async function fetchComments(postId, postElement) {
    try {
      const response = await fetch('api/fetch-comments', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ postId }),
      });
  
      const data = await response.json();
  
      
      const commentsElement = document.createElement('div');
      commentsElement.classList.add('comments');
  
      data.comments.forEach(comment => {
        const commentAuthor = document.createElement('h4');
        commentAuthor.textContent = `${comment.username}`;        
        commentsElement.appendChild(commentAuthor);
        const commentElement = document.createElement('p');
        commentElement.textContent = `${comment.comment_content}`;
        commentsElement.appendChild(commentElement);
      });
  
      postElement.appendChild(commentsElement);
    } catch (error) {
      console.error('Error fetching comments:', error);
    }
  }

 
 async function removePost(postId) {
  try {
    const response = await fetch('api/remove-post', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({ postId }),
    });

    const data = await response.json();
    console.log('Post removed');
  } catch (error) {
    console.error('Error removing post:', error);
  }

}

 
 async function submitComment(postId, username, commentContent, postElement) {
  try {
    const response = await fetch('api/submit-comment', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({ postId, commentContent }),
    });

    const data = await response.json();
    console.log(data.message);

    
    const commentsElement = document.createElement('div');
    commentsElement.classList.add('comments');
    const commentCreator = document.createElement('h4');
    commentCreator.textContent = `${username}`;
    commentsElement.appendChild(commentCreator);
    const commentElement = document.createElement('p');
    commentElement.textContent = `${commentContent}`;
    commentsElement.appendChild(commentElement);

    postElement.appendChild(commentsElement);
  } catch (error) {
    console.error('Error submitting comment:', error);
  }
}

  
  
  
  
  
  
    
      
  
  
