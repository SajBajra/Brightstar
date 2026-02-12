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
		if (listEl.children.length <= 1) {
			return;
		}

		var interval = parseInt(listEl.getAttribute('data-interval') || '4000', 10);
		if (!interval || interval < 1000) {
			interval = 4000;
		}

		function getStepHeight() {
			var firstItem = listEl.querySelector('.edu-hero-job-card');
			if (!firstItem) {
				return 0;
			}
			var styles = window.getComputedStyle(firstItem);
			var marginBottom = parseFloat(styles.marginBottom || '0');
			return firstItem.offsetHeight + marginBottom;
		}

		var stepHeight = getStepHeight();
		if (!stepHeight) {
			return;
		}

		var lastTime = performance.now();
		var travelled = 0;

		function loop(now) {
			var dt = now - lastTime;
			lastTime = now;

			// Pixels to move this frame: stepHeight over "interval" ms.
			var distance = (stepHeight / interval) * dt;
			travelled += distance;
			listEl.style.transform = 'translateY(' + (-travelled) + 'px)';

			// When we've moved one item height, recycle the first item.
			while (travelled >= stepHeight) {
				travelled -= stepHeight;
				var first = listEl.firstElementChild;
				if (!first) {
					break;
				}
				listEl.appendChild(first);
				stepHeight = getStepHeight();
				if (!stepHeight) {
					travelled = 0;
					listEl.style.transform = '';
					break;
				}
			}

			requestAnimationFrame(loop);
		}

		requestAnimationFrame(loop);
	});
});

