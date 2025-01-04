// Get buttons and popups
const contactFormBtn = document.getElementById("contactFormBtn");
const feedbackFormBtn = document.getElementById("feedbackFormBtn");
const contactFormPopup = document.getElementById("contactFormPopup");
const feedbackFormPopup = document.getElementById("feedbackFormPopup");

// Get close buttons
const closeContactForm = document.getElementById("closeContactForm");
const closeFeedbackForm = document.getElementById("closeFeedbackForm");

// Open popups
contactFormBtn.addEventListener("click", () => {
  contactFormPopup.style.display = "block";
});

feedbackFormBtn.addEventListener("click", () => {
  feedbackFormPopup.style.display = "block";
});

// Close popups
closeContactForm.addEventListener("click", () => {
  contactFormPopup.style.display = "none";
});

closeFeedbackForm.addEventListener("click", () => {
  feedbackFormPopup.style.display = "none";
});

// Close popup when clicking outside
window.addEventListener("click", (e) => {
  if (e.target === contactFormPopup) {
    contactFormPopup.style.display = "none";
  }
  if (e.target === feedbackFormPopup) {
    feedbackFormPopup.style.display = "none";
  }
});

// Load reviews
function loadMoreReviews() {
  let hiddenReviews = document.querySelectorAll(".testimonial-card.hidden");
  
  hiddenReviews.forEach(review => {
    review.classList.remove("hidden");
  });

  // Hide the "Load More" button after revealing the reviews
  document.getElementById("loadMore").style.display = "none";
}

document.getElementById("loadMore").addEventListener("click", loadMoreReviews);

// document.addEventListener("DOMContentLoaded", function () {
//   function loadReviews() {
//       fetch("fetch_reviews.php")  // Calls PHP script
//           .then(response => response.text())
//           .then(data => {
//               document.getElementById("testimonial-container").innerHTML = data;
//               addReadMoreFunctionality();
//           });
//   }

//   function addReadMoreFunctionality() {
//       document.querySelectorAll(".read-more").forEach(button => {
//           button.addEventListener("click", function () {
//               let shortText = this.previousElementSibling.previousElementSibling;
//               let fullText = this.previousElementSibling;

//               if (fullText.style.display === "none") {
//                   fullText.style.display = "block"; // Show full text
//                   shortText.style.display = "none"; // Hide short preview
//                   this.innerText = "Read Less";
//               } else {
//                   fullText.style.display = "none"; // Hide full text
//                   shortText.style.display = "block"; // Show short preview
//                   this.innerText = "Read More";
//               }
//           });
//       });
//   }

//   loadReviews();  // Load reviews when page loads
//   setInterval(loadReviews, 30000);  // Refresh every 30 seconds
// });


// function loadMoreReviews(event) {
//   let hiddenReviews = document.querySelectorAll(".testimonial-card.hidden");
//   hiddenReviews.forEach(review => {
//       review.classList.remove("hidden");
//   });
//   event.target.style.display = "none"; // Hide button after loading more
// }

// document.getElementById("loadMore").addEventListener("click", loadMoreReviews);
