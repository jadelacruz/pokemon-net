import * as yup from 'yup';

const RegisterSchema = yup.object({
    name: yup.string()
        .required()
        .min(6)
        .max(50)
        .label('Name'),
    username: yup.string()
        .required()
        .min(8)
        .max(16)
        .matches(/^[a-zA-Z0-9]+$/, 'Username should only container alphanumeric keys')
        .label('Username'),
    password: yup.string()
        .required()
        .min(8)
        .max(16)
        .label('Password'),
    rePassword: yup.string()
        .required()
        .oneOf([yup.ref('password')], 'Password do not match')
});

export default RegisterSchema;
