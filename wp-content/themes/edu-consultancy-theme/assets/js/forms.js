/* global eduForms */

'use strict';

(function () {
	function handleAjaxFormSubmit(event) {
		event.preventDefault();

		var form = event.target;
		var messageEl = form.querySelector('.edu-consultation-message, .edu-job-application-message');

		if (!messageEl) {
			messageEl = document.createElement('div');
			messageEl.className = 'edu-consultation-message';
			form.appendChild(messageEl);
		}

		messageEl.textContent = '';
		messageEl.classList.remove('is-success', 'is-error');

		var formData = new FormData(form);

		// Ensure nonce is present (fallback if not rendered).
		if (!formData.get('edu_nonce') && window.eduForms && eduForms.nonce) {
			formData.set('edu_nonce', eduForms.nonce);
		}

		var endpoint = (window.eduForms && eduForms.ajax_url) ? eduForms.ajax_url : form.getAttribute('action');

		fetch(endpoint, {
			method: 'POST',
			credentials: 'same-origin',
			body: formData
		})
			.then(function (response) {
				return response.json();
			})
			.then(function (data) {
				if (data && data.success) {
					messageEl.textContent = data.data && data.data.message ? data.data.message : 'Thank you. Your request has been submitted.';
					messageEl.classList.add('is-success');
					// Only reset non-file forms automatically.
					if (!form.classList.contains('edu-job-application-form')) {
						form.reset();
					}
				} else {
					var error = (data && data.data && data.data.message) ? data.data.message : 'Something went wrong. Please try again.';
					messageEl.textContent = error;
					messageEl.classList.add('is-error');
				}
			})
			.catch(function () {
				messageEl.textContent = 'Network error. Please check your connection and try again.';
				messageEl.classList.add('is-error');
			});
	}

	document.addEventListener('submit', function (event) {
		if (!event.target) {
			return;
		}

		if (
			event.target.classList.contains('edu-consultation-form') ||
			event.target.classList.contains('edu-job-application-form')
		) {
			handleAjaxFormSubmit(event);
		}
	});
})();


