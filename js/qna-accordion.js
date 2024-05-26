const faqs = document. querySelectorAll(".faq");
faqs.forEach((faq) => {
    faq.addEventListener("click", () => {
        console.log("FAQ clicked:", faq);
        faq.classList.toggle("active");
    });
});