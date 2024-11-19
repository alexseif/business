import {
    registerReactControllerComponents
} from '@symfony/ux-react';
import './bootstrap.js';
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));