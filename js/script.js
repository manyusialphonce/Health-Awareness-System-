// Animate match percentage bars
document.addEventListener('DOMContentLoaded', () => {
    const results = document.querySelectorAll('.disease-result h4');
    results.forEach(res => {
        const text = res.innerText;
        const match = text.match(/\((\d+)%\)/);
        if(match){
            const percent = match[1];
            const bar = document.createElement('div');
            bar.style.height = '8px';
            bar.style.backgroundColor = '#1f6de0';
            bar.style.width = '0%';
            bar.style.borderRadius = '5px';
            bar.style.marginTop = '5px';
            res.parentNode.insertBefore(bar, res.nextSibling);
            setTimeout(() => { bar.style.width = percent+'%'; }, 100);
        }
    });
});

// Animate alert messages
document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade-out');
        }, 4000); // fade out after 4 seconds
    });
});



// Animate alerts
document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade-out');
        }, 4000); // fade out after 4 seconds
    });
});