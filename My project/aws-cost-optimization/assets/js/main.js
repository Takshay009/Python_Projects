/*
 * AWS Cost Optimization Portfolio Website
 * Main JavaScript Functionality
 * 
 * Features:
 * - Mobile menu toggle
 * - Smooth scrolling
 * - Sticky header
 * - Form validation and AJAX submission
 * - Scroll animations
 */

// ============================================
// MOBILE MENU TOGGLE
// ============================================
document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.querySelector('.menu-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (menuToggle) {
    menuToggle.addEventListener('click', function () {
      this.classList.toggle('active');
      navMenu.classList.toggle('active');
      document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
    });

    // Close menu when clicking on a nav link
    const navLinks = document.querySelectorAll('.nav-menu .nav-link:not(.nav-link-dropdown)');
    navLinks.forEach(link => {
      link.addEventListener('click', function () {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
        document.body.style.overflow = '';
      });
    });

    // Mobile dropdown toggle
    const dropdownLink = document.querySelector('.nav-dropdown > .nav-link-dropdown');
    if (dropdownLink) {
      dropdownLink.addEventListener('click', function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          this.closest('.nav-dropdown').classList.toggle('open');
        }
      });
    }
  }

  // Close dropdown items on click (mobile)
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  dropdownItems.forEach(item => {
    item.addEventListener('click', function () {
      if (window.innerWidth <= 768 && menuToggle) {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  });
});

// ============================================
// STICKY HEADER ON SCROLL
// ============================================
window.addEventListener('scroll', function () {
  const header = document.querySelector('.header');
  if (header) {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }
});

// ============================================
// SMOOTH SCROLL FOR ANCHOR LINKS
// ============================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href !== '#' && href !== '#!') {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        const headerOffset = 80;
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    }
  });
});

// ============================================
// CONTACT FORM VALIDATION & SUBMISSION
// ============================================
// Contact form logic handled via PHP in index.php
// AJAX submission removed for simplicity

// ============================================
// FORM VALIDATION HELPERS
// ============================================
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function showError(fieldId, errorMessage) {
  const field = document.getElementById(fieldId);
  const formGroup = field.closest('.form-group');
  const errorElement = formGroup.querySelector('.form-error');

  formGroup.classList.add('error');
  if (errorElement) {
    errorElement.textContent = errorMessage;
    errorElement.style.display = 'block';
  }
}

function clearFormErrors() {
  const formGroups = document.querySelectorAll('.form-group');
  formGroups.forEach(group => {
    group.classList.remove('error');
    const errorElement = group.querySelector('.form-error');
    if (errorElement) {
      errorElement.style.display = 'none';
    }
  });
}

// ============================================
// AJAX FORM SUBMISSION
// ============================================
// AJAX submitForm function removed

// ============================================
// SUCCESS/ERROR MESSAGE DISPLAY
// ============================================
function showSuccessMessage(message) {
  const messageDiv = document.createElement('div');
  messageDiv.className = 'alert alert-success';
  messageDiv.innerHTML = `
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    <span>${message}</span>
  `;

  displayMessage(messageDiv);
}

function showErrorMessage(message) {
  const messageDiv = document.createElement('div');
  messageDiv.className = 'alert alert-error';
  messageDiv.innerHTML = `
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
    </svg>
    <span>${message}</span>
  `;

  displayMessage(messageDiv);
}

function displayMessage(messageDiv) {
  const contactForm = document.querySelector('form[method="POST"]');
  if (!contactForm) return;

  // Remove any existing messages
  const existingMessage = document.querySelector('.alert');
  if (existingMessage) {
    existingMessage.remove();
  }

  // Insert message before form
  contactForm.parentNode.insertBefore(messageDiv, contactForm);

  // Scroll to message
  messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

  // Auto-remove after 5 seconds
  setTimeout(() => {
    messageDiv.style.opacity = '0';
    setTimeout(() => messageDiv.remove(), 300);
  }, 5000);
}

// ============================================
// SCROLL ANIMATIONS
// ============================================
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function (entries) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-fade-in-up');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe elements with animation class
document.addEventListener('DOMContentLoaded', function () {
  const animateElements = document.querySelectorAll('.card, .section-header');
  animateElements.forEach(el => observer.observe(el));
});

// ============================================
// ACTIVE NAVIGATION LINK
// ============================================
function setActiveNavLink() {
  const currentPage = window.location.pathname.split('/').pop() || 'index.php';
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPage || (currentPage === '' && href === 'index.php')) {
      link.classList.add('active');
    }
  });
}

document.addEventListener('DOMContentLoaded', setActiveNavLink);
