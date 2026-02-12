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
});

