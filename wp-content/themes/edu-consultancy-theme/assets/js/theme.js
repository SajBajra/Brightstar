'use strict';

// Placeholder for theme-wide JavaScript.
// Keep this minimal. Use Elementor for most front-end interactions.

document.addEventListener('DOMContentLoaded', function () {
	// Example: FAQ toggle for elements using .edu-faq-item.
	document.querySelectorAll('.edu-faq-question').forEach(function (trigger) {
		trigger.addEventListener('click', function () {
			var item = trigger.closest('.edu-faq-item');
			if (!item) {
				return;
			}

			item.classList.toggle('is-open');
		});
	});

	// Vertical auto-scrolling hero jobs lists.
	document.querySelectorAll('.edu-hero-jobs-list').forEach(function (listEl) {
		var interval = parseInt(listEl.getAttribute('data-interval') || '4000', 10);
		if (!interval || interval < 1000) {
			interval = 4000;
		}

		var isAnimating = false;

		if (listEl.children.length <= 1) {
			return;
		}

		setInterval(function () {
			if (isAnimating) {
				return;
			}

			var firstItem = listEl.querySelector('.edu-hero-job-card');
			if (!firstItem) {
				return;
			}

			var itemHeight = firstItem.offsetHeight;
			var styles = window.getComputedStyle(firstItem);
			var marginBottom = parseFloat(styles.marginBottom || '0');
			var translateY = itemHeight + marginBottom;

			isAnimating = true;
			listEl.style.transition = 'transform 0.45s ease';
			listEl.style.transform = 'translateY(' + (-translateY) + 'px)';

			var handleTransitionEnd = function () {
				listEl.style.transition = '';
				listEl.style.transform = '';
				listEl.appendChild(firstItem);
				listEl.removeEventListener('transitionend', handleTransitionEnd);
				isAnimating = false;
			};

			listEl.addEventListener('transitionend', handleTransitionEnd);
		}, interval);
	});
});

