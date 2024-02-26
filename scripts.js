// Updated scripts.js with reply script

document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners when the DOM is fully loaded
    setupEventListeners();
});

function setupEventListeners() {
    // Attach event listeners for like buttons, reply buttons, and submit reply buttons
    attachLikeButtonListeners();
    attachReplyButtonListeners();
    attachSubmitReplyButtonListeners();
}

function attachLikeButtonListeners() {
    // Example: Attach event listeners for like buttons
    document.getElementById('likeButton1').addEventListener('click', function () {
        handleLikeButtonClick(1);
    });

    document.getElementById('likeButton2').addEventListener('click', function () {
        handleLikeButtonClick(2);
    });

    // Add more as needed
}

function handleLikeButtonClick(postId) {
    // Example: Handle the like button click for the specified post
    console.log('Like button clicked for post:', postId);

    // You can implement AJAX logic here to update the like count on the server
}

function attachReplyButtonListeners() {
    // Example: Attach event listeners for reply buttons
    document.getElementById('replyButton1').addEventListener('click', function () {
        toggleReplyWindow(1);
    });

    document.getElementById('replyButton2').addEventListener('click', function () {
        toggleReplyWindow(2);
    });

    // Add more as needed
}

function toggleReplyWindow(postId) {
    // Example: Toggle the visibility of the reply window for the specified post
    const replyWindow = document.getElementById(`replyWindow${postId}`);
    if (replyWindow.style.display === 'none' || replyWindow.style.display === '') {
        replyWindow.style.display = 'block';
    } else {
        replyWindow.style.display = 'none';
    }
}

function attachSubmitReplyButtonListeners() {
    // Example: Attach event listeners for submit reply buttons
    document.getElementById('submitReplyButton1').addEventListener('click', function () {
        submitReply(1);
    });

    document.getElementById('submitReplyButton2').addEventListener('click', function () {
        submitReply(2);
    });

    // Add more as needed
}

function submitReply(postId) {
    // Example: Handle the submission of a reply for the specified post
    const replyTextarea = document.getElementById(`replyTextarea${postId}`);
    const replyContent = replyTextarea.value.trim();

    if (replyContent !== '') {
        // You can implement AJAX logic here to submit the reply to the server
        console.log(`Reply submitted for post ${postId}:`, replyContent);

        // Clear the textarea after submission
        replyTextarea.value = '';

        // Optionally, hide the reply window
        toggleReplyWindow(postId);
    }
}
