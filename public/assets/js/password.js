const inputs = document.querySelectorAll("#codeForm .code-container input");

inputs.forEach((input, index) => {
    input.addEventListener("input", e => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        if(e.target.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", e => {
        if(e.key === "Backspace" && !input.value && index > 0) {
            inputs[index - 1].focus();
        }
    });
});

document.getElementById("codeForm").addEventListener("submit", e => {
    e.preventDefault();
    let code = Array.from(inputs).map(input => input.value).join('');
    if(code.length === inputs.length) {
        window.location.href = "passwordView.php";
    }
});
