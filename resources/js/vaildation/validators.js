import {extend} from 'vee-validate';


import { email, required, required_if, min, max, confirmed } from 'vee-validate/dist/rules';

extend('email', {
    ...email,
});
extend('required', {
    ...required,
});
extend('required_if', {
    ...required_if,
});
extend('min', {
    ...min,
});
extend('max', {
    ...max,
});
extend('confirmed', {
    ...confirmed,
});
