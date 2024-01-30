<template>
    <div class="testScreenContainer">
        <div class="testScreen-wrapper">
            <div class="headingWrapper">
                <v-row>
                    <v-col cols="6">
                        <div style="display: flex;align-items: center;">
                            <span style="display: inline;"><v-img class="backArrow" :src="arrow"
                                    @click="goBack"></v-img></span>
                            <span class="p-tags stepsHead">

                                Previous <span class="stepsHead-span">Record</span>
                                <p class="p-tags stepsSubHead">Follow the required 4 steps to start you journey...</p>
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
                <div class="subHeaderPreview">
                    <v-text-field class="textField" variant="outlined" placeholder="Search here..."
                        prepend-icon="mdi-magnify"></v-text-field>
                    <v-text-field class="textField" variant="outlined" @click="openDatePicker" prepend-icon="mdi-calendar"
                        :value="formattedDate"></v-text-field>
                    <v-dialog class="datepicker-Dialog" v-model="isDatePickerOpen">
                        <v-card>
                            <v-card-text>
                                <v-date-picker v-model="selectedDate"></v-date-picker>
                            </v-card-text>
                        </v-card>
                    </v-dialog>
                </div>
                <div>
                    <v-table class="table">
                        <thead class="tableHead">
                            <tr>
                                <th class="text-center tableHeadHeading">
                                    Name
                                </th>
                                <th class="text-center tableHeadHeading">
                                    Exp
                                </th>
                                <th class="text-center tableHeadHeading">
                                    Email
                                </th>
                                <th class="text-center tableHeadHeading">
                                    Obtain Marks
                                </th>
                                <th class="text-center tableHeadHeading">
                                    Total Marks
                                </th>
                                <th class="text-center tableHeadHeading">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="tableBody">
                            <tr v-for="item in desserts" :key="item.name">
                                <td class="tableBodyTxt">{{ item.name }}</td>
                                <td class="tableBodyTxt">{{ item.skills }}</td>
                                <td class="tableBodyTxt">{{ item.email }}</td>
                                <td class="tableBodyTxt">{{ item.obtain_marks }}</td>
                                <td class="tableBodyTxt">{{ item.total_marks }}</td> 
                                <td class="tableBodyTxt">
                                    <router-link :to="{ name: 'singleresult', params: { id: item.id } }">
                                        <v-img class="viewIcon" :src="view"></v-img>
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
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
import html2pdf from "html2pdf.js";



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
            desserts: [],
            candidate: null,
            questions: [],
            tests: [],
            completeTests: [],
        }
    },
    mounted() {
        this.getCandidate();
    },
    methods: {
        openDatePicker() {
            this.isDatePickerOpen = true;
        },
        goBack() {
            // this.$router.go('');
            this.$router.push('/');
        },



        async fetchData(candidateId) {
            try {

                // console.log(candidateId)
                // Fetch candidate information
                const candidateResponse = await axios.get(`http://localhost:8000/api/testresult/${candidateId}`);

                this.candidate = candidateResponse.data;
                console.log(candidateResponse.data);

                // this.tests = testResponse.data;

                // this.completeTests = completeTestsResponse.data;

                // this.questions = questionsResponse.data;

            } catch (error) {
                console.error("Error fetching data:", error);
                throw error;
            }
        },

        generatePDF(candidateId) {
            this.fetchData(candidateId).then(() => {

                // Create PDF content using the fetched data
                const pdfContent = this.createPDFContent();

                // Generate PDF using html2pdf.js
                const pdfOptions = {
                    margin: 10,
                    filename: "candidate_report.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
                };

                html2pdf().from(pdfContent).set(pdfOptions).outputPdf();
            });
        },

        createPDFContent() {
            // Customize the HTML content based on your data
            const content = `
        <div>
          <!-- Page 1: Candidate Information -->
          <h1>Candidate Information</h1>
          <p>Name: ${this.candidate.name}</p>
          <p>Email: ${this.candidate.email}</p>
          <!-- Add other candidate details as needed -->

          <!-- Page 2: Test Questions -->
          <h1>Test Questions</h1>
           

          <!-- Page 3: Test Results -->
          <h1>Test Results</h1>
        </div>
      `;
            //   ${this.renderQuestions()}
            return content;
        },
        // renderQuestions() {
        //   // Customize the rendering of questions based on your data
        //   return this.questions.map((question) => `
        //     <div>
        //       <p>Question: ${question.question}</p>
        //       <p>Options: ${question.opt1}, ${question.opt2}, ${question.opt3}, ${question.opt4}</p>
        //       <!-- Add other question details as needed -->
        //     </div>
        //   `).join('');
        // },
        // renderTestResults() {
        // Customize the rendering of test results based on your data
        //   return this.completeTests.map((completeTest) => `
        //     <div>
        //       <p>Question: ${completeTest.question_id}</p>
        //       <p>Selected Option: ${completeTest.selected_opt}</p>
        //       <p>Mark: ${completeTest.mark}</p>
        //       <!-- Add other test result details as needed -->
        //     </div>
        //   `).join('');
        // },

        // get all candidate when page load
        async getCandidate() {
            try {
                const response = await axios.get('http://localhost:8000/api/testcandidate');

                this.desserts = response.data.data;
                console.log(this.desserts);

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
</style>
<style>
.v-field__field .v-field__input {
    padding: 0 !important;
}
</style>