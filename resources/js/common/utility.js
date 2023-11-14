const handleValidationError = (errors, exception) => {
    if (exception.name !== 'ValidationError') return;

    errors.value = {};
    exception.inner
        .forEach((exception) => {
            errors.value[exception.path] = exception.errors;
        });

}
const handleAxiosError      = (errors, exception) => {
    if (exception.name !== 'AxiosError') return;

    errors.value = {};
    errors.value = exception.response.data?.errors;
}

const isAtBottom = () => {
    const scrollTop = window.scrollY || window.pageYOffset;

    const totalHeight = document.documentElement.scrollHeight;

    const windowHeight = window.innerHeight || document.documentElement.clientHeight;

    return totalHeight - scrollTop - windowHeight < 10;
}

export {
    handleValidationError,
    handleAxiosError,
    isAtBottom
};
