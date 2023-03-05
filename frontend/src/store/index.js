import { createStore } from 'vuex'

export default createStore({
  state: {
    token:""
  },
  getters: {
  },
  mutations: {
    login (state,token) {
      state.token = token;
      localStorage.setItem('token', token);
      alert('Logged in');
    },
    logout(state){
      state.token ="";
      localStorage.removeItem('token');
      alert('Logged out');
    },
    initialiseStore(state) {
      if(localStorage.getItem('token')){
        state.email = localStorage.getItem('token');
       }
    }
  },
  actions: {
  },
  modules: {
  }
})