import Axios from 'axios';

window.axios = Axios.create()
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common['Content-Type'] = 'application/json';
// window.axios.defaults.headers.common['Accept'] = 'application/json';


import './alpineComponents/dashboard';
import './alpineComponents/users';
import './alpineComponents/roles';
import './alpineComponents/permissions';
import './alpineComponents/companies';
import './alpineComponents/documents';
import './alpineComponents/approvals';
import './alpineComponents/equipment';
import './alpineComponents/settings';
import './alpineStores/attachments';

