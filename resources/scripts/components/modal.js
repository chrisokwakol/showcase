import * as focusTrap from 'focus-trap';

export const modal = () => {

	let trap = null;
	let modalTriggers = null;

	/**
	 * Initialize the component if any modal triggers are onthe page. 
	 * @returns void
	 */

	const init = () => {
		modalTriggers = document.querySelectorAll('.modal-toggle');

		if(modalTriggers === undefined || modalTriggers === null || modalTriggers.length === 0) return;

		// Listen for clicks on all modal trigger buttons. 
		modalTriggers.forEach(button => {
			button.addEventListener('click', () => {

			// rebind a new focus trap specifically for this modal. 
			trap = focusTrap.createFocusTrap(document.getElementById(button.getAttribute('aria-controls')));

			openModal(button, trap);
			});
		});

		// Close modal when clicking on the overlay
		document.addEventListener('click', (event) => {
			if (event.target.classList.contains('modal__overlay')) {
				closeModals();
			}
		});

		// Close modal when clicking on the close button
		document.querySelectorAll('.modal__close').forEach(button => {
			button.addEventListener('click', (event) => {
				event.stopPropagation();
				closeModals();
			});
		});

		// Close modal when pressing Esc
		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape') {
				closeModals();
			}
		});
	}


	/**
	 * 
	 * @param {HTMLButtonElement} button 
	 * @param {focusTrap | null} trap 
	 * @returns void
	 */
	const openModal = (button, trap) => {
		
			if(button === undefined || button === null) return;

			const toggleId = button.getAttribute('aria-controls');
			const modal = document.getElementById(toggleId);
			
			if(modal === undefined || modal === null) return;
			
			modal.classList.add('active');
			modal.querySelector('.modal__card').classList.add('active');
			modal.querySelector('.modal__overlay').classList.add('active');
			
			document.getElementsByTagName('html')[0].style.overflow = 'hidden';
			
			if(trap !== null) {
				trap.activate();
			}
			
	}


	/**
	 * Method that closes all modals and resets the buttons to aria-expanded false. 
	 */
  const closeModals = () => {

		modalTriggers.forEach(button => button.setAttribute('aria-expanded', false));

    document.querySelectorAll('.modal__wrap').forEach(modal => {
      
      modal.classList.remove('active');
      modal.querySelector('.modal__card').classList.remove('active');
      modal.querySelector('.modal__overlay').classList.remove('active');

    });
		
		document.getElementsByTagName('html')[0].style.overflow = 'auto';

		if(trap !== null) {
			trap.deactivate();
		}

  }

	
	init();
	
}

import.meta.webpackHot?.accept(modal);
