/**
 * CTR Brand Search Fix - Global Event Delegation
 * Ensures search works even with dynamic content loading.
 * Includes A-Z Filter Logic, Debouncing, and "No Results" Message.
 */
document.addEventListener('DOMContentLoaded', function () {

    // Debounce Utility
    function debounce(func, wait) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                func.apply(context, args);
            }, wait);
        };
    }

    // Core Filter Function
    function performFilter(textQuery, letterQuery) {
        var grid = document.getElementById('ctr-force-grid-target');
        if (!grid) return;

        var cards = grid.querySelectorAll('.ctr-force-card');
        var textFilter = textQuery ? textQuery.toLowerCase().trim() : '';
        var letterFilter = letterQuery ? letterQuery.toLowerCase() : 'all';
        var visibleCount = 0;

        for (var i = 0; i < cards.length; i++) {
            var card = cards[i];
            var dataName = card.getAttribute('data-brand-name') || '';
            var visibleText = card.textContent || card.innerText || '';
            var searchable = (dataName + ' ' + visibleText).toLowerCase();

            // Check Text Match
            var textMatch = true;
            if (textFilter) {
                textMatch = searchable.indexOf(textFilter) > -1;
            }

            // Check Letter Match
            var letterMatch = true;
            if (letterFilter !== 'all') {
                if (letterFilter === '0-9') {
                    // Check if starts with number
                    letterMatch = /^[0-9]/.test(dataName);
                } else {
                    // Check if starts with letter
                    letterMatch = dataName.startsWith(letterFilter);
                }
            }

            // Final Visibility
            if (textMatch && letterMatch) {
                card.style.setProperty('display', 'flex', 'important');
                visibleCount++;
            } else {
                card.style.setProperty('display', 'none', 'important');
            }
        }

        // Handle "No Results" Message
        handleNoResults(grid, visibleCount);
    }

    // Show/Hide "No Results" Message
    function handleNoResults(grid, count) {
        var msgId = 'ctr-no-results-msg';
        var msg = document.getElementById(msgId);

        if (count === 0) {
            if (!msg) {
                msg = document.createElement('div');
                msg.id = msgId;
                msg.textContent = 'No brands found matching your criteria.';
                msg.style.cssText = 'width: 100%; text-align: center; padding: 40px; color: rgba(255,255,255,0.5); font-family: "Orbitron", sans-serif; font-size: 16px; grid-column: 1 / -1;';
                grid.appendChild(msg);
            }
            msg.style.display = 'block';
        } else {
            if (msg) {
                msg.style.display = 'none';
            }
        }
    }

    // State Management
    var currentText = '';
    var currentLetter = 'all';

    // 1. Text Search Listener (Debounced)
    var debouncedSearch = debounce(function (e) {
        if (e.target && e.target.id === 'ctrBrandSearch') {
            currentText = e.target.value;
            performFilter(currentText, currentLetter);
        }
    }, 150); // 150ms delay for smoother typing

    document.body.addEventListener('input', debouncedSearch);

    // 2. A-Z Filter Listener
    document.body.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('ctr-az-btn')) {
            e.preventDefault();

            // Update Active State
            var buttons = document.querySelectorAll('.ctr-az-btn');
            buttons.forEach(function (btn) { btn.classList.remove('active'); });
            e.target.classList.add('active');

            // Update Filter
            currentLetter = e.target.getAttribute('data-letter');

            // Clear text search on letter click for simplicity
            var input = document.getElementById('ctrBrandSearch');
            if (input) {
                input.value = '';
                currentText = '';
            }

            performFilter(currentText, currentLetter);
        }
    });

    // Initial Check
    var input = document.getElementById('ctrBrandSearch');
    if (input && input.value) {
        currentText = input.value;
        performFilter(currentText, currentLetter);
    }
});
