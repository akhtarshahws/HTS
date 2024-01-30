<template>
    <div class="testScreenContainer">
        <div class="testScreen-wrapper">
            <div class="headingWrapper">
                <v-row>
                    <v-col cols="6">
                        <div style="display: flex;align-items: center;">
                            <span style="display: inline;">
                                <v-img class="backArrow" :src="arrow" @click="goBack"></v-img>
                            </span>
                            <span class="p-tags stepsHead">

                                Test<span class="stepsHead-span"> Record</span>
                                <p class="p-tags stepsSubHead">Record of the Single test ...</p>
                            </span>
                        </div>

                    </v-col>
                    <v-col cols="12" lg="6" md="12">
                        <div class="passedWrapper">
                            <!-- <p class="passed-failed">PASSED</p> -->
                            <img :src="down" class="download" />
                        </div>
                    </v-col>
                </v-row>
            </div>
            <v-divider class="testScreenDivider"></v-divider>
            <div>
                <!-- Display candidate information -->
                <div class="subHeaderPreview">
                    Candidate Result Info
                </div>
                <div>
                    <v-table class="table">
                        <thead class="tableHead">
                            <tr>
                                <th class="text-center tableHeadHeading">Name</th>
                                <th class="text-center tableHeadHeading">Exp</th>
                                <th class="text-center tableHeadHeading">Email</th>
                                <th class="text-center tableHeadHeading">Obtain Marks</th>
                                <th class="text-center tableHeadHeading">Total Marks</th>
                            </tr>
                        </thead>
                        <tbody class="tableBody">
                            <tr :key="desserts.candidate.id">
                                <td class="tableBodyTxt">{{ desserts.candidate.name }}</td>
                                <td class="tableBodyTxt">{{ desserts.candidate.skills }}</td>
                                <td class="tableBodyTxt">{{ desserts.candidate.email }}</td>
                                <td class="tableBodyTxt">{{ desserts.obtain_marks }}</td>
                                <td class="tableBodyTxt">{{ desserts.total_marks }}</td>
                            </tr>
                        </tbody>
                    </v-table>
                </div>

                <!-- Display complete test information -->
                <div class="subHeaderPreview">
                    Complete test Record
                </div>
                <div>
                    <!-- <v-table class="table" v-for="item in desserts.complete_tests" :key="item.id">
    <thead class="tableHead">
      <tr style="text-align: left;">
        <th  style="text-align: left;" class="text-center tableHeadHeading" colspan="4">{{ item.question.question }}</th>
      </tr>
    </thead>
    <tbody class="tableBody">
        <tr>
            <td class="tableBodyTxt" colspan="4">Options</td>
        </tr>
      <tr>

        <td class="tableBodyTxt">1.{{ item.question.opt1 }}</td>
        <td class="tableBodyTxt">2.{{ item.question.opt2 }}</td>
        <td class="tableBodyTxt">3.{{ item.question.opt3 }}</td>
        <td class="tableBodyTxt">4.{{ item.question.opt4 }}</td>
      </tr>
      <tr>

        <td> Selected Option </td>
        <td >{{ item.selected_opt }}</td>
        <td>Correct Option</td>
        <td >{{ item.question.correct_opt }}</td>

      </tr>
    </tbody>
  </v-table> -->
                    <div v-for="(item, index) in desserts.complete_tests" :key="item.id">
                        <v-expansion-panels color="#00102C" class="my-4 expensionQuestion">
                            <v-expansion-panel>
                                <v-expansion-panel-title>
                                    Q.{{ index + 1 }} {{ item.question.question }}
                                </v-expansion-panel-title>
                                <v-expansion-panel-text class="expensionAnswerExpender">
                                    <div class="answerRow">
                                        <v-row>
                                            <v-col>
                                                <h2>Question Options</h2>
                                                <p><span class="optionBold">Option 1.</span>{{ item.question.opt1 }}</p>
                                                <p><span class="optionBold">Option 1.</span>{{ item.question.opt2 }}</p>
                                                <p><span class="optionBold">Option 1.</span>{{ item.question.opt3 }}</p>
                                                <p><span class="optionBold">Option 1.</span>{{ item.question.opt4 }}</p>

                                            </v-col>
                                            <v-col>
                                                <h2>Correct Answer</h2>
                                                <p>Option {{ item.question.correct_opt }} is the correct Answer</p>
                                            </v-col>
                                            <v-col>
                                                <h2>Selected Answer</h2>
                                                <p>Option {{ item.selected_opt }} is the selected Answer</p>
                                            </v-col>
                                        </v-row>
                                    </div>
                                    <!-- <div style="color: white;">
            <v-radio-group v-model="item.selected_opt">
              <v-row class="questionRow">
                <v-col cols="12" sm="12" lg="6" md="6">
                  <v-radio
                    :checked="isSelected(item.question.opt1, item.selected_opt)"
                    color="#4B9AFA"
                    :label="item.question.opt1"
                    :disabled="true"
                    value="option1"
                  ></v-radio>
                  <v-radio
                    :checked="isSelected(item.question.opt2, item.selected_opt)"
                    color="#4B9AFA"
                    :label="item.question.opt2"
                    :disabled="true"
                    value="option2"
                  ></v-radio>
                </v-col>
                <v-col cols="12" sm="12" lg="6" md="6">
                  <v-radio
                    :checked="isSelected(item.question.opt3, item.selected_opt)"
                    color="#4B9AFA"
                    :label="item.question.opt3"
                    :disabled="true"
                    value="option3"
                  ></v-radio>
                  <v-radio
                    :checked="isSelected(item.question.opt4, item.selected_opt)"
                    color="#4B9AFA"
                    :label="item.question.opt4"
                    :disabled="true"
                    value="option4"
                  ></v-radio>
                </v-col>
              </v-row>
            </v-radio-group>
            <div>
              Correct Option: {{ item.question.correct_opt }}
              Selected Option: {{ item.selected_opt }}
            </div>
          </div> -->
                                </v-expansion-panel-text>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </div>
                </div>

            </div>
            <FooterCom class="footerInTestScreen" />
        </div>
    </div>
</template>

<script>
import down from '../assets/imgs/down.png'
import FooterCom from '../components/helperComponents/FooterCom.vue'
import view from '../assets/imgs/view.svg'
import moment from 'moment';
import arrow from '../assets/imgs/arrow.svg'
import axios from "axios";
// import html2pdf from "html2pdf.js";

export default {
    components: {
        FooterCom: FooterCom

    },

    data() {
        return {
            isDatePickerOpen: false,
            selectedDate: null,
            down: down,
            view: view,
            arrow: arrow,
            desserts: {
                complete_tests: {},
                candidate: {}

            },
        }
    },
    mounted() {
        const candidateId = this.$route.params.id;
        this.getCandidate(candidateId);
    },
    methods: {
        goBack() {
            this.$router.push('/preview');
        },


        isSelected(index, selectedOpt) {
            return index === selectedOpt;
        },

        // get all candidate when page load
        async getCandidate(candidateId) {
            try {
                // Replace with the actual candidate ID
                const response = await axios.get(`http://localhost:8000/api/testresult/${candidateId}`);

                console.log(response.data.data);

                this.desserts = response.data.data;

            } catch (error) {
                console.error("Error:", error);
            }
        },

    },
    computed: {
        formattedDate() {
            if (this.selectedDate) {
                return moment(this.selectedDate).format('MMM DD, YYYY');
            }
            return '';
        },
    },

}
</script>

<style scoped>
.outerMostDiv-Review {
    background: #00102C;
    height: 100%;
    padding: 0 0 20px 0;
}

.reviewQuestion {
    color: #FFF;
    font-family: Roboto;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
}

.nextBtn {
    border-radius: 60px;
    background: #4B9AFA;
    color: #FFF;
    text-align: center;
    font-family: Roboto;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;
    width: 168px;
    height: 68px;
}

.optionBold {
    font-weight: 700;
}

.divider {
    color: white;
    margin: 2% 0 3% 0;
}

.reviewHeading {
    color: #F5F5F5;
    font-family: Open Sans;
    font-size: 36px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    margin-top: 5%;
}

.v-expansion-panel-title {
    color: #FFF;
    font-family: Roboto;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
}

.reviewHeading-span {
    color: #4B9AFA;
    font-weight: 700;

}

.reviewSubPara {
    color: #F5F5F5;
    font-family: Open Sans;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.headingWrapper {
    width: 85vw;
}

.expansionWrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.expensionQuestion {
    width: 85vw;

}

.questionRow {
    padding: 0 5%;
}

.answerRow {
    background-color: #00102C;
    color: white;
}

.expensionQuestion .v-expansion-panel {
    border-radius: 60px;
    border: 1px solid #4B9AFA;
    background-color: #00102C;
    overflow: hidden;
    opacity: 0.3;
}

.v-expansion-panel-title__overlay {
    opacity: 0;
}

.v-expansion-panel .v-expansion-panel-text {
    background-color: rgb(0, 0, 0) !important;
}

.headingWrapper {
    width: 85vw;
}

.v-expansion-panel .v-expansion-panel-text[data-v-32340455] {
    background-color: #00102C !important;
    border-radius: 0 0 60px 60px;
    border-left: 1px solid #4B9AFA;
}

.v-expansion-panel-title {
    background-color: #00102C;
    color: white;
    min-height: 70px;

}

.reviewDivBtn {
    display: flex;
    justify-content: end;
    width: 100%;
    max-width: 85vw;
}

button .v-expansion-panel-title__overlay {
    opacity: 0 !important;
}

.testScreen-wrapper {
    max-width: 85vw;
    width: 100%;
    padding-top: 2%;
    position: relative;
}

.stepsHead {
    color: #F5F5F5;
    font-family: Open Sans;
    font-size: 36px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    margin-top: 5% !important;
}

.backArrow {
    min-width: 48px !important;
    max-width: 50px !important;
    margin-top: 5px;
    cursor: pointer;
    margin-right: 15px;
}

.stepsHead-span {
    color: #4B9AFA;
    font-weight: 700;
}

.table {
    border-radius: 20px;
    border: 2px solid rgba(75, 154, 250, 0.3);
    background-color: #00102C;
    color: white;

}

.datepicker-Dialog {
    max-width: 444px;
    max-height: auto;
}

.v-card-text {
    padding: 0 !important;
}

.v-card-text .v-sheet .v-picker-title {
    padding-bottom: 0 !important;
}

.subHeaderPreview {
    display: flex;
    justify-content: end;
    padding-bottom: 20px;
}

.datepicker-Dialog {
    scrollbar-width: thin;
    scrollbar-color: #00102C #fff;

    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background-color: #fff;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #00102C;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #00102C;
    }
}

.tableHeadHeading {
    color: #F5F5F5;
    text-align: center;
    font-family: Open Sans;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.tableBodyTxt {
    color: #F5F5F5;
    text-align: center;
    font-family: Open Sans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.v-table .v-table__wrapper>table>tbody>tr:not(:last-child)>td,
.v-table .v-table__wrapper>table>tbody>tr:not(:last-child)>th {
    border-bottom: thin solid rgba(75, 154, 250, 0.3);
}

.textField {
    border-radius: 60px;
    border: 2px solid #4B9AFA;
    height: 62px;
    max-width: 374px;
    padding: 0 25px;
    margin-left: 10px;
}

.tableHead {
    border-radius: 20px 20px 0px 0px;
    border: 2px solid rgba(75, 154, 250, 0.20);
    background: #071E40;
}

.viewIcon {
    width: 20px;
    margin: 0 auto;
    cursor: pointer;
}

.stepsSubHead {
    color: #F5F5F5;
    font-family: Open Sans;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.passedWrapper {
    display: flex;
    justify-content: end;
    height: 100%;
    align-items: end;
}

.download {
    cursor: pointer;
}

.headingWrapper {
    width: 85vw;
}

.testScreenDivider {
    margin: 2% 0 4% 0;
}

.testScreenContainer {
    background: #00102C;
    height: 100%;
    color: white;
    display: flex;
    justify-content: center;
}

.v-date-picker {
    background-color: #071E40;
    color: white;
}

.v-card-text {
    background-color: #071E40;
}

.v-field__field .v-field__input {
    padding: 0 !important;
}

.expensionQuestion .v-expansion-panel-text__wrapper {
    background: #00102C;
    border-radius: 0px 0px 55px 55px;
    padding: 0 !important;
}
</style>
<style>
.expensionAnswerExpender .v-expansion-panel-text__wrapper {
    padding: 0 !important;
}

.expensionAnswerExpender .v-expansion-panel-text__wrapper .answerRow {
    padding: 2% 5% !important;
}
</style>
