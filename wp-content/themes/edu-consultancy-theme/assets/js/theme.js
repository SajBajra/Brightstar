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

	// Vertical auto-scrolling hero jobs lists (seamless infinite loop).
	document.querySelectorAll('.edu-hero-jobs-list').forEach(function (listEl) {
		var items = listEl.querySelectorAll('.edu-hero-job-card');
		if (!items.length) {
			return;
		}

		var interval = parseInt(listEl.getAttribute('data-interval') || '4000', 10);
		if (!interval || interval < 1000) {
			interval = 4000;
		}

		// Duplicate the items once so we can loop seamlessly.
		items.forEach(function (item) {
			listEl.appendChild(item.cloneNode(true));
		});

		// Height of a single full set of items.
		var singleSetHeight = listEl.scrollHeight / 2;
		if (!singleSetHeight) {
			return;
		}

		// Approximate speed so that roughly one item passes per interval.
		var averageItemHeight = singleSetHeight / items.length;
		var speed = averageItemHeight / interval; // px per ms.

		var lastTime = performance.now();
		var offset = 0;

		function loop(now) {
			var dt = now - lastTime;
			lastTime = now;

			offset -= speed * dt;

			// When we've scrolled past one full set, jump back by that height.
			// Because the content is duplicated, the jump is visually seamless.
			if (offset <= -singleSetHeight) {
				offset += singleSetHeight;
			}

			listEl.style.transform = 'translateY(' + offset + 'px)';

			requestAnimationFrame(loop);
		}

		requestAnimationFrame(loop);
	});
});

