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

	// Vertical auto-scrolling hero jobs lists (smooth continuous loop).
	document.querySelectorAll('.edu-hero-jobs-list').forEach(function (listEl) {
		var items = listEl.querySelectorAll('.edu-hero-job-card');
		if (!items.length) {
			return;
		}

		var interval = parseInt(listEl.getAttribute('data-interval') || '4000', 10);
		if (!interval || interval < 1000) {
			interval = 4000;
		}

		// Assume consistent height for hero job cards.
		var firstItem = items[0];
		var styles = window.getComputedStyle(firstItem);
		var marginBottom = parseFloat(styles.marginBottom || '0');
		var stepHeight = firstItem.offsetHeight + marginBottom;
		if (!stepHeight) {
			return;
		}

		// Duplicate all items once to allow seamless looping.
		items.forEach(function (item) {
			var clone = item.cloneNode(true);
			listEl.appendChild(clone);
		});

		var originalHeight = stepHeight * items.length;
		var lastTime = performance.now();
		var offset = 0;

		function loop(now) {
			var dt = now - lastTime;
			lastTime = now;

			// Distance per ms: move one card height every "interval" ms.
			var distance = (stepHeight / interval) * dt;
			offset -= distance;

			// When we've scrolled past the original list height, reset offset
			// so the second (cloned) set becomes the new start with no visual jump.
			if (offset <= -originalHeight) {
				offset += originalHeight;
			}

			listEl.style.transform = 'translateY(' + offset + 'px)';

			requestAnimationFrame(loop);
		}

		requestAnimationFrame(loop);
	});
});

