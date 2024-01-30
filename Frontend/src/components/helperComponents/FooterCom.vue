<template>
    <div>
        <v-card class="footerCardWrapper" elevation="0">
            <v-row style="margin-top: 1.75%;">
                <v-col cols="9" lg="9" md="8" sm="7" xs="12" class="footerLeftCol">
                    <!-- <v-divider class="hr-footer"></v-divider> -->
                    <hr class="hr-footer" />
                </v-col>
                <v-col cols="3" lg="3" md="4" sm="4" xs="12" class="footerRightCol">
                    <span class="powered-by">Powered By:</span>
                    <v-img class="footer-logo" src="../../assets/imgs/tgi.svg"></v-img>
                </v-col>
            </v-row>
        </v-card>
    </div>
</template>

<script>
export default {

}
</script>

<style  scoped>
.footer-logo {
    min-width: 61px;
    max-width: 62px;
    margin-left: 20px;
}

.footerCardWrapper {
    background: #00102C;
    margin-top: 5%;
    margin-bottom: 2%;
}

.powered-by {
    color: #FFF;
    font-family: Open Sans;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.hr-footer {
    background-color: white;
    height: 1px;
    opacity: 0.2;
    margin-top: 30px;

}

.footerRightCol {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* .footerLeftCol{
    display: flex;
} */
@media (max-width:850px) {
    .powered-by {
        font-size: 20px;
    }

    .footer-logo {
        min-width: 40px !important;
        max-width: 40px !important;
    }
}

@media (max-width:693px) {

    .powered-by {
        font-size: 14px;
    }

    .footerLeftCol {
        max-width: 60vw !important;
    }

    .footer-logo {
        min-width: 30px !important;
        max-width: 30px !important;
    }
}
</style>