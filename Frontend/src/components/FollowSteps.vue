<template>
  <StarterScreen v-if="showStarterScreen" />
  <div v-else class="followSteps-outerMostDiv">
    <div class="followSteps-outerDiv">
      <div v-if="!showReview" class="flexWrapper-div">
        <div class="headingWrapper" v-motion :initial="{ opacity: 0 }" :enter="{
          opacity: 1,
          transition: { duration: 300, delay: 200, ease: 'easeIn' },
        }">
          <v-row>
            <v-col cols="6" lg="6" md="6" sm="12">
              <div>
                <p class="p-tags stepsHead">
                  Follow the <span class="stepsHead-span">Steps</span>
                </p>
                <p class="p-tags stepsSubHead">
                  Follow the required 4 steps to start your journey...
                </p>
              </div>
            </v-col>
            <v-col cols="6" lg="6" md="6" sm="12">
              <div class="previewBtnHolder">
                <router-link to="/preview">
                  <v-btn class="previewBTN">Previous Record</v-btn>
                </router-link>
              </div>
            </v-col>
          </v-row>
        </div>
      </div>
      <!-- ===============testing========= -->
      <div v-if="!showReview" class="stepperFlexDiv">
        <div class="headingWrapper">
          <v-divider class="stepperTopDivider" color="white"></v-divider>
          <v-stepper v-model="step" :items="items" show-actions vertical class="stepper">
            <!-- <template v-for="(item, index) in items" :key="index" v-slot:[`item${index}`]> -->
            <div class="stepperWindowWrapper">
              <v-stepper-window>
                <v-sheet border>
                  <!-- ========just for index 0 not in the code========== -->
                  <v-stepper-window-item class="stepperScrollingWindow">
                    <div>
                      <p class="stepperFirstHead">
                        Step <span class="stepperFirstHead-txt">01</span>/05
                      </p>
                      <p class="stepperSecondHead">Interviewee Name</p>
                      <v-text-field placeholder="Interviewee name..."></v-text-field>
                    </div>
                  </v-stepper-window-item>
                  <!-- ===================== -->
                  <v-stepper-window-item class="stepperScrollingWindow">
                    <div v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: {
                        duration: 300,
                        delay: 400,
                        ease: 'easeIn',
                      },
                    }">
                      <div>
                        <p class="stepperFirstHead">
                          Step <span class="stepperFirstHead-txt">01</span>/05
                        </p>
                        <p class="stepperSecondHead">Interviewee Name</p>
                        <v-text-field class="textField" variant="outlined" placeholder="Interviewee name"
                          v-model="intervieweeName"></v-text-field>
                        <div>
                          <v-btn @click="moveToNextStep" class="view-detail continueBTN"
                            :disabled="!isStepValid(1)">Next</v-btn>
                        </div>
                      </div>
                    </div>
                    <!-- <div>
                                            <p class="stepperFirstHead">Step <span class="stepperFirstHead-txt">01</span>/05
                                            </p>
                                            <p class="stepperSecondHead">Interviewee Name</p>
                                            <v-text-field class="textField" variant="outlined"
                                                placeholder="Interviewee name..." v-model="intervieweeName"></v-text-field>
                                            <div>
                                                <v-btn @click="moveToNextStep" class="view-detail continueBTN"
                                                    :disabled="!isStepValid(1)">Next</v-btn>
                                            </div>
                                        </div> -->
                  </v-stepper-window-item>
                  <v-stepper-window-item class="stepperScrollingWindow">
                    <div v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: {
                        duration: 300,
                        delay: 200,
                        ease: 'easeIn',
                      },
                    }">
                      <p class="stepperFirstHead">
                        Step <span class="stepperFirstHead-txt">02</span>/05
                      </p>
                      <p class="stepperSecondHead">Interviewer Name</p>
                      <v-text-field class="textField" variant="outlined" placeholder="Interviewer name"
                        v-model="interviewerName"></v-text-field>
                      <div>
                        <v-btn @click="moveToNextStep" class="view-detail continueBTN"
                          :disabled="!isStepValid(2)">Next</v-btn>
                      </div>
                    </div>
                  </v-stepper-window-item>
                  <v-stepper-window-item class="stepperScrollingWindow">
                    <div v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: {
                        duration: 300,
                        delay: 200,
                        ease: 'easeIn',
                      },
                    }">
                      <p class="stepperFirstHead">
                        Step <span class="stepperFirstHead-txt">03</span>/05
                      </p>
                      <p class="stepperSecondHead">Position Applied For</p>
                      <!-- <v-text-field class="textField" variant="outlined" placeholder="Position..."
                                                v-model="positionAppliedFor"> </v-text-field> -->
                      <!-- <v-text-field class="textField" variant="outlined" placeholder="Position..."
                                                v-model="positionAppliedFor"> </v-text-field> -->

                      <select v-model="positionAppliedFor" id="postAppliedFor" class="form-control" required style="
                          background: rgba(255, 255, 255, 0);
                          width: 100%; /* Adjust the width as needed */
                          height: 60px;
                          border: 1px solid rgba(75, 154, 250, 0.8);
                          border-radius: 50px;
                          padding: 5px;
                          padding-left: 30px;
                          color: rgba(75, 154, 250, 0.8);
                        ">
                        <option disabled value="">Select Position</option>
                        <option value="Laravel">Laravel</option>
                        <option value="IOS">IOS</option>
                        <option value="Android">Android</option>
                        <option value="PHP">PHP</option>
                        <option value="SQA">SQA</option>
                        <option value="UI/UX">UI/UX</option>
                        <option value="React">React</option>
                        <option value="Vue">Vue</option>
                      </select>
                      <div>
                        <v-btn @click="moveToNextStep" class="view-detail continueBTN"
                          :disabled="!isStepValid(3)">Next</v-btn>
                      </div>
                    </div>
                  </v-stepper-window-item>
                  <v-stepper-window-item class="stepperScrollingWindow">
                    <div v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: {
                        duration: 300,
                        delay: 200,
                        ease: 'easeIn',
                      },
                    }">
                      <p class="stepperFirstHead">
                        Step <span class="stepperFirstHead-txt">04</span>/05
                      </p>
                      <p class="stepperSecondHead">Experience</p>
                      <v-text-field class="textField" variant="outlined" placeholder="Experience in Years"
                        v-model="experience"></v-text-field>
                      <div>
                        <v-btn @click="moveToNextStep" class="view-detail continueBTN"
                          :disabled="!isStepValid(4)">Next</v-btn>
                      </div>
                    </div>
                  </v-stepper-window-item>
                  <v-stepper-window-item class="stepperScrollingWindow">
                    <div v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: {
                        duration: 300,
                        delay: 200,
                        ease: 'easeIn',
                      },
                    }">
                      <p class="stepperFirstHead">
                        Step <span class="stepperFirstHead-txt">05</span>/05
                      </p>
                      <p class="stepperSecondHead">Enter Email</p>
                      <v-text-field class="textField" variant="outlined" placeholder="Email..."
                        v-model="email"></v-text-field>
                      <div>
                        <v-btn @click="showReview = true" class="view-detail continueBTN"
                          :disabled="!isStepValid(5)">Next</v-btn>
                        <!-- <v-btn @click="showReview = true" class="view-detail continueBTN">VIEW
                                                    DETAILS</v-btn> -->
                      </div>
                    </div>
                  </v-stepper-window-item>
                </v-sheet>
              </v-stepper-window>
            </div>
            <!-- </template> -->
          </v-stepper>
        </div>
      </div>
      <div v-if="!showReview" style="margin: 0 auto" class="headingWrapper">
        <div>
          <FooterCom />
        </div>
      </div>

      <!-- ==============testing=========== -->
      <div v-if="showReview" class="flexWrapper-div">
        <div>
          <div>
            <div class="headingWrapper" v-motion :initial="{ opacity: 0 }" :enter="{
              opacity: 1,
              transition: { duration: 300, delay: 200, ease: 'easeIn' },
            }">
              <p class="p-tags stepsHead">
                Review <span class="stepsHead-span">Details</span>
              </p>
              <p class="p-tags stepsSubHead">Follow are the details</p>
              <v-divider class="stepperTopDivider" color="white"></v-divider>
              <div>
                <v-row class="reviewRow">
                  <v-col cols="4" md="6" sm="12">
                    <div class="reviewCardDiv" v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: { duration: 300, delay: 300, ease: 'easeIn' },
                    }">
                      <div class="customFlexWrapper">
                        <span class="profileSpanner">
                          <img :src="profUrl" alt="" />
                        </span>
                        <div class="reviewCardtxtHolder">
                          <p class="label">Interviewee name</p>
                          <p class="labelTxt">
                            <!-- John Wick -->
                            {{ intervieweeName }}
                          </p>
                        </div>
                      </div>
                      <span>
                        <v-btn class="editBtn" @click="editIntervieweeName">edit</v-btn>
                      </span>
                    </div>
                  </v-col>
                  <v-col cols="4" md="6" sm="12">
                    <div class="reviewCardDiv" v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: { duration: 300, delay: 400, ease: 'easeIn' },
                    }">
                      <div class="customFlexWrapper">
                        <span class="profileSpanner">
                          <img :src="profUrl" alt="" />
                        </span>
                        <div class="reviewCardtxtHolder">
                          <p class="label">Interviewer name</p>
                          <p class="labelTxt">
                            <!-- Peter k -->
                            {{ interviewerName }}
                          </p>
                        </div>
                      </div>
                      <span>
                        <v-btn class="editBtn" @click="editInterviewerName">edit</v-btn>
                      </span>
                    </div>
                  </v-col>
                  <v-col cols="4" md="6" sm="12">
                    <div class="reviewCardDiv" v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: { duration: 300, delay: 500, ease: 'easeIn' },
                    }">
                      <div class="customFlexWrapper">
                        <span class="profileSpanner">
                          <img :src="profUrl" alt="" />
                        </span>
                        <div class="reviewCardtxtHolder">
                          <p class="label">Position Applied For</p>
                          <p class="labelTxt">
                            <!-- Php Developer -->
                            {{ positionAppliedFor }}
                          </p>
                        </div>
                      </div>
                      <span>
                        <v-btn class="editBtn" @click="editPosition">edit</v-btn>
                      </span>
                    </div>
                  </v-col>
                  <v-col cols="4" md="6" sm="12">
                    <div class="reviewCardDiv" v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: { duration: 300, delay: 600, ease: 'easeIn' },
                    }">
                      <div class="customFlexWrapper">
                        <span class="profileSpanner">
                          <img :src="profUrl" alt="" />
                        </span>
                        <div class="reviewCardtxtHolder">
                          <p class="label">Experience</p>
                          <p class="labelTxt">
                            <!-- 2 Years -->
                            {{ experience }}
                          </p>
                        </div>
                      </div>
                      <span>
                        <v-btn class="editBtn" @click="editExperience">edit</v-btn>
                      </span>
                    </div>
                  </v-col>
                  <v-col cols="4" md="6" sm="12">
                    <div class="reviewCardDiv" v-motion :initial="{ opacity: 0 }" :enter="{
                      opacity: 1,
                      transition: { duration: 300, delay: 700, ease: 'easeIn' },
                    }">
                      <div class="customFlexWrapper">
                        <span class="profileSpanner">
                          <img :src="profUrl" alt="" />
                        </span>
                        <div class="reviewCardtxtHolder">
                          <p class="label">Email</p>
                          <p class="labelTxt">
                            <!-- tgi@gmail.com -->
                            {{ email }}
                          </p>
                        </div>
                      </div>
                      <span>
                        <v-btn class="editBtn" @click="editEmail">edit</v-btn>
                      </span>
                    </div>
                  </v-col>
                </v-row>
                <div>
                  <!-- <router-link to="/review"> -->
                  <v-btn class="continueBTN" @click="submitForm">Continue</v-btn>
                  <!-- </router-link> -->
                </div>
              </div>

            </div>
          </div>
          <FooterCom />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FooterCom from "../components/helperComponents/FooterCom.vue";
import StarterScreen from "./StarterScreen.vue";
import prof from "../assets/imgs/profile.png";
import axios from "axios";
export default {
  components: {
    StarterScreen: StarterScreen,
    FooterCom: FooterCom,
  },
  data: () => ({
    profUrl: prof,
    showStarterScreen: true,
    shipping: 0,
    showReview: false,
    step: 1,
    intervieweeName: "",
    interviewerName: "",
    positionAppliedFor: "",
    experience: "",
    email: "",
    items: [
      "Interviewee Name",
      "Interviewer Name",
      "Position applied for",
      "Experience",
      "Email",
    ],
  }),
  methods: {
    moveToNextStep() {
      if (this.step < this.items.length) {
        this.step++;
      }
    },
    editIntervieweeName() {
      this.showReview = false;
      this.step = this.items.indexOf("Interviewee Name") + 1;
      window.scrollTo(0, 0);
    },
    editInterviewerName() {
      this.showReview = false;
      this.step = this.items.indexOf("Interviewer Name") + 1;
      window.scrollTo(0, 0);
    },
    editPosition() {
      this.showReview = false;
      this.step = this.items.indexOf("Position applied for") + 1;
      window.scrollTo(0, 0);
    },
    editExperience() {
      this.showReview = false;
      this.step = this.items.indexOf("Experience") + 1;
      window.scrollTo(0, 0);
    },
    editEmail() {
      this.showReview = false;
      this.step = this.items.indexOf("Email") + 1;
      window.scrollTo(0, 0);
    },

    // use async to store data
    async submitForm() {
      try {
        // Prepare the data object
        const postData = {
          name: this.intervieweeName,
          father_name: "father",
          email: this.email,
          phone: "034599999999",
          post_applied_for: this.positionAppliedFor,
          skills: this.experience,
          interviewer: this.interviewerName,
        };

        // Make a POST request to your API endpoint
        const response = await axios.post(
          "http://127.0.0.1:8000/api/createcandidate",
          postData
        );

        // send response.data to review page

        // this.$router.push({
        //         name: 'review_questions',
        //         params: {
        //         data: response.data
        //         }
        //     });

        this.$router.push("/start/" + response.data.candidate_id);

        // console.log('candidate Id: ', response.data.candidate_id);
        // console.log('question : ', response.data.questions);
      } catch (error) {
        // Handle errors (e.g., show error message)
        console.error("Error:", error);
      }
    },
  },
  computed: {
    subtotal() {
      return this.products.reduce(
        (acc, product) => acc + product.quantity * product.price,
        0
      );
    },
    total() {
      return this.subtotal + Number(this.shipping ?? 0);
    },
    isStepValid() {
      return (step) => {
        switch (step) {
          case 1:
            return /^[a-zA-Z\s]+$/.test(this.intervieweeName.trim()) && this.intervieweeName.length <= 25;
          case 2:
            return /^[a-zA-Z\s]+$/.test(this.interviewerName.trim()) && this.interviewerName.length <= 25;
          case 3:
            return this.positionAppliedFor;
          // return /^[a-zA-Z\s]+$/.test(this.positionAppliedFor.trim());
          case 4:
            return /^[a-zA-Z0-9\s]+$/.test(this.experience.trim());
          case 5:
            return /\S+@\S+\.\S+/.test(this.email.trim());
          default:
            return false;
        }
      };
    },
  },
  mounted() {
    // Set a timeout to hide the StarterScreen after 3 seconds
    setTimeout(() => {
      this.showStarterScreen = false;
    }, 3000);
  },
};
</script>

<style scoped>
.stepsHead {
  color: #f5f5f5;
  font-family: Open Sans;
  font-size: 36px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  margin-top: 5% !important;
}

.stepperSecondHead {
  color: #f5f5f5;
  font-family: Open Sans;
  font-size: 24px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  margin-bottom: 25px;
}

.previewBtnHolder {
  display: flex;
  justify-content: end;
  align-items: end;
  height: 100%;
}

/* .form-control {
  background-color: #00102c;
} */
.form-control option {
  background-color: #00102c;
}

.previewBTN {
  border-radius: 60px;
  background: #4b9afa;
  color: #fff;
  text-align: center;
  font-family: Roboto;
  font-size: 18px !important;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-transform: uppercase;
  height: 62px;
}

.stepperFirstHead-txt {
  font-weight: 700;
}

.stepperWindowWrapper {
  width: 70%;
  margin-top: 3%;
}

.continueBTN {
  margin: 10px 0;
}

.editBtn {
  background: #4b9afa;
  color: #fff;
  text-align: center;
  font-family: Roboto;
  font-size: 15px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
  text-transform: capitalize;
}

.textField {
  border-radius: 60px;
  border: 2px solid #4b9afa;
  height: 62px;
}

.view-detail {
  margin-left: auto;
  display: block;
  margin-top: 50px;
  width: 168px !important;
  height: 62px !important;
}

.stepperFirstHead {
  color: #f5f5f5;
  font-family: Open Sans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  margin-bottom: 9px;
}

.v-window-item {
  background-color: #00102c;
  border: 0;
  color: #fff;
  height: 350px;
  padding: 2px;
}

.v-sheet {
  width: 100%;
  border: 0;
}

.v-stepper-item .v-avatar {
  width: 49px !important;
  height: 49px !important;
  font-size: 20px !important;
}

.stepsHead-span {
  color: #4b9afa;
  font-weight: 700;
}

.followSteps-outerMostDiv {
  height: 100%;
}

.followSteps-outerDiv {
  background-color: #00102c;
  height: 100%;
}

.p-tags {
  margin: 0;
}

.reviewCardDiv {
  display: flex;
  padding: 10px;
  justify-content: space-between;
}

.continueBTN {
  color: #fff;
  text-align: center;
  font-family: Roboto;
  font-size: 18px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-transform: uppercase;
  border-radius: 60px;
  background: #4b9afa;
  width: 273px;
  height: 62px;
}

.customFlexWrapper {
  display: flex;
}

.stepsSubHead {
  color: #f5f5f5;
  font-family: Open Sans;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.flexWrapper-div {
  display: flex;
  justify-content: center;
}

.headingWrapper {
  width: 85vw;
}

.v-stepper {
  display: flex;
}

.stepper> :first-child {
  display: flex;
  flex-direction: column;
  border-right: 1px solid rgba(255, 255, 255, 0.2);
}

.reviewCardtxtHolder {
  padding: 0 0 0 30px;
}

.reviewRow {
  /* background-color: red; */
  margin: 0;
  padding: 3% 0;
}

.stepper {
  background-color: #00102c;
  box-shadow: none;
  color: white;
}

.stepperTopDivider {
  margin: 3% 0 0 0;
  opacity: 0.2;
}

.stepperFlexDiv {
  display: flex;
  justify-content: center;
}

.v-sheet {
  position: relative;
}

.label {
  color: #f5f5f5;
  font-family: Open Sans;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.labelTxt {
  color: #f5f5f5;
  font-family: Open Sans;
  font-size: 20px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

@media (max-width: 920px) {
  .continueBTN {
    width: 170px;
    height: 60px;
  }
}
</style>
<style>
.textField .v-field__field .v-field__input {
  padding-left: 20px !important;
}

.v-stepper-actions {
  max-height: 100px;
  /* background: red !important; */
  position: absolute;
  bottom: 0;
  right: 0;
}

.v-stepper-item {
  /* margin: 5% 0 0 0; */
}

.v-stepper-item--selected .v-stepper-item__title {
  color: #4b9afa !important;
}

.v-stepper-item__content .v-stepper-item__title {
  color: #f5f5f5;
  text-align: right;
  font-family: Open Sans;
  font-size: 20px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: left;
}

.v-stepper-actions .v-btn {
  display: none;
}

.profileSpanner {
  width: 48px;
  height: 48px;
  border-radius: 60px;
  background: #4b9afa;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
<style>
.v-field__outline {
  display: none !important;
}

.v-stepper-header .v-stepper-item .v-avatar {
  width: 49px !important;
  height: 49px !important;
  font-size: 0px !important;
  background-repeat: no-repeat !important;
  background-position: center !important;
}

.v-stepper-header .v-stepper-item:nth-child(1) .v-avatar {
  background-image: url(../assets/imgs/profile.png) !important;
}

.v-stepper-header .v-stepper-item:nth-child(3) .v-avatar {
  background-image: url(../assets/imgs/interviewer.png) !important;
}

.v-stepper-header .v-stepper-item:nth-child(5) .v-avatar {
  background-image: url(../assets/imgs/position.png) !important;
}

.v-stepper-header .v-stepper-item:nth-child(7) .v-avatar {
  background-image: url(../assets/imgs/experience.png) !important;
}

.v-stepper-header .v-stepper-item:nth-child(9) .v-avatar {
  background-image: url(../assets/imgs/mail.svg) !important;
}

.v-stepper-header {
  overflow: hidden;
}

.v-stepper-item--selected .v-avatar {
  /* background-color: #4B9AFA !important; */
  background: rgba(75, 154, 250, 0.8) !important;
}

.v-stepper-item .v-avatar {
  background: rgba(75, 154, 250, 0.1);
}

.v-stepper-item {
  transform: scale(1);
  transition: transform 0.3s ease;
}

.v-stepper-item--selected {
  transform: scale(1.1);
}

.v-btn--disabled.v-btn--variant-elevated,
.v-btn--disabled.v-btn--variant-flat {
  opacity: 0.5;
}
</style>
