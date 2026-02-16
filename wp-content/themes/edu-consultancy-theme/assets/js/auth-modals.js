'use strict';

(function () {
	if (typeof eduAuthModals === 'undefined') {
		return;
	}

	var triggers = document.querySelectorAll('.edu-modal-trigger');
	var modals = {
		login: document.getElementById('edu-login-modal'),
		register: document.getElementById('edu-register-modal')
	};

	function openModal(id) {
		var modal = modals[id];
		if (!modal) return;
		modal.classList.add('edu-modal--open');
		modal.setAttribute('aria-hidden', 'false');
		document.body.classList.add('edu-modal-open');
		var firstInput = modal.querySelector('input:not([type="hidden"]), button[type="submit"]');
		if (firstInput) {
			setTimeout(function () { firstInput.focus(); }, 100);
		}
	}

	function closeModal(modal) {
		if (!modal) return;
		modal.classList.remove('edu-modal--open');
		modal.setAttribute('aria-hidden', 'true');
		if (!document.querySelector('.edu-modal--open')) {
			document.body.classList.remove('edu-modal-open');
		}
	}

	function closeAll() {
		Object.keys(modals).forEach(function (id) {
			if (modals[id]) closeModal(modals[id]);
		});
	}

	triggers.forEach(function (a) {
		a.addEventListener('click', function (e) {
			e.preventDefault();
			var id = a.getAttribute('data-modal');
			if (id && modals[id]) openModal(id);
		});
	});

	document.querySelectorAll('.edu-modal').forEach(function (modal) {
		modal.querySelectorAll('[data-close]').forEach(function (el) {
			el.addEventListener('click', function () { closeModal(modal); });
		});
	});

	document.querySelectorAll('.edu-modal-switch').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var targetId = btn.getAttribute('data-modal');
			document.querySelectorAll('.edu-modal--open').forEach(function (m) { closeModal(m); });
			if (targetId && modals[targetId]) openModal(targetId);
		});
	});

	document.addEventListener('keydown', function (e) {
		if (e.key !== 'Escape') return;
		var open = document.querySelector('.edu-modal--open');
		if (open) closeModal(open);
	});

	// Form submit: login
	var loginForm = document.querySelector('.edu-login-form');
	if (loginForm) {
		loginForm.addEventListener('submit', function (e) {
			e.preventDefault();
			var msgEl = loginForm.querySelector('.edu-modal-form__message');
			var btn = loginForm.querySelector('button[type="submit"]');
			msgEl.textContent = '';
			msgEl.className = 'edu-modal-form__row edu-modal-form__message';
			if (btn) btn.disabled = true;

			var formData = new FormData(loginForm);
			formData.append('action', 'edu_modal_login');
			formData.append('nonce', eduAuthModals.login_nonce);

			fetch(eduAuthModals.ajax_url, {
				method: 'POST',
				body: formData,
				credentials: 'same-origin'
			})
				.then(function (r) { return r.json(); })
				.then(function (data) {
					if (data.success && data.data && data.data.redirect) {
						msgEl.textContent = eduAuthModals.strings.login_success;
						msgEl.classList.add('edu-modal-form__message--success');
						window.location.href = data.data.redirect;
						return;
					}
					msgEl.textContent = (data.data && data.data.message) ? data.data.message : eduAuthModals.strings.error_generic;
					msgEl.classList.add('edu-modal-form__message--error');
					if (btn) btn.disabled = false;
				})
				.catch(function () {
					msgEl.textContent = eduAuthModals.strings.error_generic;
					msgEl.classList.add('edu-modal-form__message--error');
					if (btn) btn.disabled = false;
				});
		});
	}

	// Form submit: register
	var registerForm = document.querySelector('.edu-register-form');
	if (registerForm) {
		registerForm.addEventListener('submit', function (e) {
			e.preventDefault();
			var msgEl = registerForm.querySelector('.edu-modal-form__message');
			var btn = registerForm.querySelector('button[type="submit"]');
			msgEl.textContent = '';
			msgEl.className = 'edu-modal-form__row edu-modal-form__message';
			if (btn) btn.disabled = true;

			var formData = new FormData(registerForm);
			formData.append('action', 'edu_modal_register');
			formData.append('nonce', eduAuthModals.register_nonce);

			fetch(eduAuthModals.ajax_url, {
				method: 'POST',
				body: formData,
				credentials: 'same-origin'
			})
				.then(function (r) { return r.json(); })
				.then(function (data) {
					if (data.success && data.data && data.data.redirect) {
						msgEl.textContent = eduAuthModals.strings.register_success;
						msgEl.classList.add('edu-modal-form__message--success');
						window.location.href = data.data.redirect;
						return;
					}
					msgEl.textContent = (data.data && data.data.message) ? data.data.message : eduAuthModals.strings.error_generic;
					msgEl.classList.add('edu-modal-form__message--error');
					if (btn) btn.disabled = false;
				})
				.catch(function () {
					msgEl.textContent = eduAuthModals.strings.error_generic;
					msgEl.classList.add('edu-modal-form__message--error');
					if (btn) btn.disabled = false;
				});
		});
	}
})();
