import './bootstrap';
import 'bootstrap';
import jQuery from 'jquery';
import moment from 'moment';
import toastr from 'toastr';
import { Fancybox } from '@fancyapps/ui';

// Make jQuery global FIRST - before any jQuery plugins
window.$ = window.jQuery = jQuery;

// Make toastr global
window.toastr = toastr;

// Import jQuery plugins AFTER jQuery is global
// jQuery UI - commented out as it's not actively used and causes loading issues
// Uncomment if you need jQuery UI features (datepicker, draggable, etc.)
// import 'jquery-ui';

import 'select2';

// Import Swiper and modules
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// Make Swiper global
window.Swiper = Swiper;

// Initialize Swiper modules
Swiper.use([Navigation, Pagination, Autoplay]);

// Ensure jQuery is available
if (typeof window.jQuery === 'undefined') {
    console.error('jQuery is not loaded!');
} else {
    console.log('jQuery loaded successfully');
}

// Ensure Swiper is available
if (typeof Swiper === 'undefined') {
    console.error('Swiper is not loaded!');
} else {
    console.log('Swiper loaded successfully');
}

// Initialize toastr with better configuration
toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    preventDuplicates: false,
    onclick: null,
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '3000',
    extendedTimeOut: '1000',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
};

// Initialize Fancybox
Fancybox.bind('[data-fancybox]', {
    // Options
});

// Flash Sale Countdown
function initFlashSaleCountdown() {
    const countdownElements = document.querySelectorAll('.flash-sale-countdown');
    
    countdownElements.forEach(element => {
        const endTime = element.getAttribute('data-end-time');
        if (!endTime) return;
        
        function updateCountdown() {
            const now = moment();
            const end = moment(endTime);
            const diff = end.diff(now);
            
            if (diff <= 0) {
                element.innerHTML = '<span class="text-danger">Đã kết thúc</span>';
                return;
            }
            
            const duration = moment.duration(diff);
            const days = Math.floor(duration.asDays());
            const hours = duration.hours();
            const minutes = duration.minutes();
            const seconds = duration.seconds();
            
            element.innerHTML = `
                <span class="countdown-item">
                    <span class="countdown-value">${String(days).padStart(2, '0')}</span>
                    <span class="countdown-label">Ngày</span>
                </span>
                <span class="countdown-separator">:</span>
                <span class="countdown-item">
                    <span class="countdown-value">${String(hours).padStart(2, '0')}</span>
                    <span class="countdown-label">Giờ</span>
                </span>
                <span class="countdown-separator">:</span>
                <span class="countdown-item">
                    <span class="countdown-value">${String(minutes).padStart(2, '0')}</span>
                    <span class="countdown-label">Phút</span>
                </span>
                <span class="countdown-separator">:</span>
                <span class="countdown-item">
                    <span class="countdown-value">${String(seconds).padStart(2, '0')}</span>
                    <span class="countdown-label">Giây</span>
                </span>
            `;
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
}

// Cart functions - ensure jQuery is available
window.addToCart = function(productId, quantity = 1) {
    // Check if jQuery is available
    if (typeof window.jQuery === 'undefined' || typeof window.$ === 'undefined') {
        console.error('jQuery is not available, using fallback');
        // Fallback to fetch API
        if (typeof window.addToCartFallback === 'function') {
            return window.addToCartFallback(productId, quantity);
        } else {
            console.error('addToCartFallback also not available');
            alert('Chức năng thêm vào giỏ hàng chưa sẵn sàng. Vui lòng tải lại trang.');
            return;
        }
    }
    
    // Use global jQuery
    const $ = window.$;
    
    // Validate quantity
    if (!quantity || quantity < 1) {
        quantity = 1;
    }
    
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (!csrfToken) {
        console.error('CSRF token not found');
        if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
            window.toastr.error('Có lỗi xảy ra. Vui lòng tải lại trang.');
        } else {
            alert('Có lỗi xảy ra. Vui lòng tải lại trang.');
        }
        return;
    }
    
    // Disable button to prevent double click
    const button = event?.target || document.querySelector('button[onclick*="addToCart"]');
    if (button) {
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
        
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: csrfToken
            },
            success: function(response) {
                if (response.success) {
                    // Check if toastr is available
                    if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
                        // Show success notification with icon
                        window.toastr.success(
                            '<i class="fas fa-check-circle me-2"></i>' + response.message + 
                            '<br><small class="text-muted" style="color: rgba(255,255,255,0.8);">Giỏ hàng của bạn có ' + response.cart_count + ' sản phẩm</small>',
                            'Đã thêm vào giỏ hàng',
                            {
                                timeOut: 4000,
                                extendedTimeOut: 2000
                            }
                        );
                    } else {
                        console.error('Toastr is not available');
                        // Fallback alert
                        alert(response.message);
                    }
                    updateCartCount(response.cart_count);
                } else {
                    if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
                        window.toastr.error(
                            '<i class="fas fa-exclamation-circle me-2"></i>' + (response.message || 'Có lỗi xảy ra.'),
                            'Lỗi',
                            {
                                timeOut: 5000
                            }
                        );
                    } else {
                        alert(response.message || 'Có lỗi xảy ra.');
                    }
                }
                if (button) {
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            },
            error: function(xhr) {
                console.error('Add to cart error:', xhr);
                let errorMessage = 'Có lỗi xảy ra. Vui lòng thử lại.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status === 422) {
                    errorMessage = 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.';
                } else if (xhr.status === 404) {
                    errorMessage = 'Sản phẩm không tồn tại.';
                }
                
                if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
                    window.toastr.error(
                        '<i class="fas fa-times-circle me-2"></i>' + errorMessage,
                        'Lỗi',
                        {
                            timeOut: 5000
                        }
                    );
                } else {
                    console.error('Toastr error:', errorMessage);
                    alert(errorMessage);
                }
                if (button) {
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            }
        });
    } else {
        // Fallback if button not found
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: csrfToken
            },
            success: function(response) {
                if (response.success) {
                    if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
                        window.toastr.success(
                            '<i class="fas fa-check-circle me-2"></i>' + response.message + 
                            '<br><small class="text-muted" style="color: rgba(255,255,255,0.8);">Giỏ hàng của bạn có ' + response.cart_count + ' sản phẩm</small>',
                            'Đã thêm vào giỏ hàng',
                            {
                                timeOut: 4000,
                                extendedTimeOut: 2000
                            }
                        );
                    } else {
                        console.error('Toastr is not available');
                        alert(response.message);
                    }
                    updateCartCount(response.cart_count);
                } else {
                    if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
                        window.toastr.error(
                            '<i class="fas fa-exclamation-circle me-2"></i>' + (response.message || 'Có lỗi xảy ra.'),
                            'Lỗi',
                            {
                                timeOut: 5000
                            }
                        );
                    } else {
                        alert(response.message || 'Có lỗi xảy ra.');
                    }
                }
            },
            error: function(xhr) {
                console.error('Add to cart error:', xhr);
                let errorMessage = 'Có lỗi xảy ra. Vui lòng thử lại.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                if (typeof toastr !== 'undefined' && typeof window.toastr !== 'undefined') {
                    window.toastr.error(
                        '<i class="fas fa-times-circle me-2"></i>' + errorMessage,
                        'Lỗi',
                        {
                            timeOut: 5000
                        }
                    );
                } else {
                    console.error('Toastr error:', errorMessage);
                    alert(errorMessage);
                }
            }
        });
    }
};

window.updateCartCount = function(count) {
    if (typeof window.$ !== 'undefined') {
        $('.cart-count').text(count || 0);
    } else {
        // Fallback for vanilla JS
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = count || 0;
        });
    }
};

// Fallback function for addToCart using fetch API (no jQuery required)
window.addToCartFallback = function(productId, quantity = 1, buttonElement = null) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        console.error('CSRF token not found');
        if (typeof window.toastr !== 'undefined') {
            window.toastr.error('Có lỗi xảy ra. Vui lòng tải lại trang.');
        } else {
            alert('Có lỗi xảy ra. Vui lòng tải lại trang.');
        }
        return;
    }
    
    const button = buttonElement || document.querySelector(`.add-to-cart-btn[data-product-id="${productId}"]`);
    const originalText = button ? button.innerHTML : '';
    
    if (button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
    }
    
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (typeof window.toastr !== 'undefined') {
                window.toastr.success(
                    '<i class="fas fa-check-circle me-2"></i>' + data.message + 
                    '<br><small style="color: rgba(255,255,255,0.8);">Giỏ hàng của bạn có ' + data.cart_count + ' sản phẩm</small>',
                    'Đã thêm vào giỏ hàng',
                    {
                        timeOut: 4000,
                        extendedTimeOut: 2000
                    }
                );
            } else {
                console.log('Toastr not available');
                alert(data.message);
            }
            window.updateCartCount(data.cart_count);
        } else {
            if (typeof window.toastr !== 'undefined') {
                window.toastr.error(
                    '<i class="fas fa-exclamation-circle me-2"></i>' + (data.message || 'Có lỗi xảy ra.'),
                    'Lỗi',
                    {
                        timeOut: 5000
                    }
                );
            } else {
                alert(data.message || 'Có lỗi xảy ra.');
            }
        }
        if (button) {
            button.disabled = false;
            button.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Add to cart error:', error);
        if (typeof window.toastr !== 'undefined') {
            window.toastr.error(
                '<i class="fas fa-times-circle me-2"></i>Có lỗi xảy ra. Vui lòng thử lại.',
                'Lỗi',
                {
                    timeOut: 5000
                }
            );
        } else {
            alert('Có lỗi xảy ra. Vui lòng thử lại.');
        }
        if (button) {
            button.disabled = false;
            button.innerHTML = originalText;
        }
    });
};

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Wait for jQuery to be available
    if (typeof window.jQuery !== 'undefined') {
        $(document).ready(function() {
            initFlashSaleCountdown();
            
            // Initialize Select2
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select2').select2();
            }
            
            // Initialize Swiper for product images
            if (typeof Swiper !== 'undefined' || typeof window.Swiper !== 'undefined') {
                const SwiperClass = window.Swiper || Swiper;
                new SwiperClass('.product-images-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
            
            // Add to cart button handler (for all buttons with class add-to-cart-btn)
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();
                const productId = $(this).data('product-id');
                const quantity = 1; // Default quantity
                
                if (productId) {
                    if (typeof window.addToCart === 'function') {
                        window.addToCart(productId, quantity);
                    } else if (typeof window.addToCartFallback === 'function') {
                        window.addToCartFallback(productId, quantity);
                    } else {
                        console.error('addToCart functions not available');
                        alert('Chức năng thêm vào giỏ hàng chưa sẵn sàng. Vui lòng tải lại trang.');
                    }
                }
            });
        });
    } else {
        // Fallback if jQuery not loaded
        console.error('jQuery not available, using vanilla JS');
        initFlashSaleCountdown();
        
        // Fallback using vanilla JS for add to cart
        document.addEventListener('click', function(e) {
            if (e.target.closest('.add-to-cart-btn')) {
                e.preventDefault();
                const button = e.target.closest('.add-to-cart-btn');
                const productId = button.getAttribute('data-product-id');
                const quantity = 1;
                
                if (productId && typeof window.addToCartFallback === 'function') {
                    window.addToCartFallback(productId, quantity);
                }
            }
        });
    }
});
