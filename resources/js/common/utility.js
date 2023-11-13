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

export { handleValidationError, handleAxiosError }
