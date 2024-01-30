import { createStore } from 'vuex';

export default createStore({
  state: {
    questionsData: [],
    candidateId: null,
  },
  mutations: {
    setQuestions(state, questionsData) {
      state.questionsData = questionsData;
    },
    setCandidateId(state, candidateId) {
      state.candidateId = candidateId;
    },
  },
});