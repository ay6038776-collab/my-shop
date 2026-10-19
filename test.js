import http from 'k6/http';

export const options = {
  vus: 5000,
  duration: '6m',
};

export default function () {
  http.get('http://127.0.0.1:8000/admin/index');
   http.get('http://127.0.0.1:8000');
 
}