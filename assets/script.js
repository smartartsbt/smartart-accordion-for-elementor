document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".accordion-toggle").forEach(function (button) {
        const wrapper = button.closest(".smart-accordion-widget");
        if (!wrapper) return;

        const content = wrapper.querySelector(".accordion-content");
        const inner = content.querySelector(".accordion-inner") || content;
        const openIcon = button.querySelector(".accordion-open");
        const closeIcon = button.querySelector(".accordion-close");
        const text = button.querySelector(".accordion-text");

        if (!content || !inner) return;

        // Get desired number of visible lines (in 'em' units)
        const visibleLines = parseInt(button.getAttribute('data-collapsed-height')) || 4;

        // Get the font size in pixels to convert 'em' to 'px'
        const fontSize = parseFloat(window.getComputedStyle(content).fontSize);

        // Get the margin-top and margin-bottom in pixels
        const contentStyle = window.getComputedStyle(content);
        const marginTop = parseFloat(contentStyle.marginTop) || 0;
        const marginBottom = parseFloat(contentStyle.marginBottom) || 0;

        // Calculate the collapsed height in pixels (using ems)
        const collapsedHeightInEm = visibleLines; // Number of visible lines
        const collapsedHeightInPx = collapsedHeightInEm * fontSize; // Convert 'em' to 'px'

        // Include margin in the collapsed height
        const totalCollapsedHeight = collapsedHeightInPx + marginTop + marginBottom;

        // Log for debugging
        console.log("Collapsed Height in em: " + collapsedHeightInEm + "em");
        console.log("Collapsed Height in px (with margin): " + totalCollapsedHeight + "px");

        // Apply initial max-height based on calculated pixels (with margin)
        content.style.maxHeight = totalCollapsedHeight + "px";

        button.addEventListener("click", function () {
            const isCollapsed = parseFloat(content.style.maxHeight) < inner.scrollHeight;

            if (isCollapsed) {
                // Expand
                content.style.maxHeight = inner.scrollHeight + "px";
                text.textContent = button.getAttribute('data-read-less');
                if (openIcon && closeIcon) {
                    openIcon.classList.add("hidden");
                    closeIcon.classList.remove("hidden");
                }
            } else {
                // Collapse
                content.style.maxHeight = totalCollapsedHeight + "px";
                text.textContent = button.getAttribute('data-read-more');
                if (openIcon && closeIcon) {
                    openIcon.classList.remove("hidden");
                    closeIcon.classList.add("hidden");
                }
            }
        });
    });
});
