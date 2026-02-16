'use strict';

// Placeholder for theme-wide JavaScript.
// Keep this minimal. Use Elementor for most front-end interactions.

document.addEventListener('DOMContentLoaded', function () {
	// Header nav toggle (mobile menu).
	var navToggle = document.querySelector('.site-header__toggle');
	var navPanel = document.getElementById('site-header-nav');
	if (navToggle && navPanel) {
		navToggle.addEventListener('click', function () {
			var open = navPanel.classList.toggle('is-open');
			navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		// Close when clicking a link (for anchor or same-page nav).
		navPanel.addEventListener('click', function (e) {
			if (e.target.closest('a') && !e.target.closest('.menu-item-has-children > a')) {
				navPanel.classList.remove('is-open');
				navToggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

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

	// Vertical auto-scrolling hero jobs lists (infinite loop with fixed set of cards).
	document.querySelectorAll('.edu-hero-jobs-list').forEach(function (listEl) {
		var items = listEl.querySelectorAll('.edu-hero-job-card');
		if (items.length <= 1) {
			return;
		}

		var interval = parseInt(listEl.getAttribute('data-interval') || '4000', 10);
		if (!interval || interval < 1000) {
			interval = 4000;
		}

		// Assume all hero job cards have same height; measure first.
		var firstItem = items[0];
		var styles = window.getComputedStyle(firstItem);
		var marginBottom = parseFloat(styles.marginBottom || '0');
		var stepHeight = firstItem.offsetHeight + marginBottom;
		if (!stepHeight) {
			return;
		}

		// Speed so that one full card passes every "interval" ms.
		var speed = stepHeight / interval; // px per ms.

		var lastTime = performance.now();
		var offset = 0;

		function loop(now) {
			var dt = now - lastTime;
			lastTime = now;

			offset -= speed * dt;

			// When a full card height has scrolled, move the first card to the end
			// and reduce the offset, so motion continues smoothly with the same set of jobs.
			while (offset <= -stepHeight) {
				offset += stepHeight;
				var first = listEl.querySelector('.edu-hero-job-card');
				if (!first) {
					break;
				}
				listEl.appendChild(first);

				// Trigger a soft fade-in on the recycled card so it does not "pop" into view.
				first.classList.add('edu-hero-job-card--enter');
				requestAnimationFrame(function () {
					first.classList.remove('edu-hero-job-card--enter');
				});
			}

			listEl.style.transform = 'translateY(' + offset + 'px)';

			requestAnimationFrame(loop);
		}

		requestAnimationFrame(loop);
	});
});

