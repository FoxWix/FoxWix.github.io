//-------------------------------------------------------------------------
//  カラーコード、配色画像パス、テンプレート配色格納用
//-------------------------------------------------------------------------
const Color = {

    ColorCode: {
        color01: "#a9a9a9",   //darkgray
        color02: "#ff4500",    //orangered
        color03: "#ffd700",    //gold
        color04: "#66cdaa",   //mediumaquamarine
        color05: "#4169e1",   //royalblue
        color06: "#9932cc"    //darkorchid
    },

    CorlorImagePath: {
        color01: "images/Color_1.png",
        color02: "images/Color_2.png",
        color03: "images/Color_3.png",
        color04: "images/Color_4.png",
        color05: "images/Color_5.png",
        color06: "images/Color_6.png",
    },
    
    //1->darkgray
    //2->orangered
    //3->gold
    //4->mediumaquamarine
    //5->royalblue
    //6->darkorchid
    TemplateColor: [
        [1],
        [1],
        [1],
        [1],
        [1],
        [1],
        [1],
        [1],
        [1],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [1],
        [1],
        [1],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6],
        [1, 2, 3, 4, 5, 6]
    ]

}

//------------------------------------------------------------------------
//  テンプレートの寸法、名前
//------------------------------------------------------------------------
const Template = [
    DJ_0 = [
        A = {
            fullname: "DJ_0_A",
            path: "images/Design01-A-preview.png"
        },
        B = {
            fullname: "DJ_0_B",
            path: "images/Design01-B-preview.png"
        },
        C = {
            fullname: "DJ_0_C",
            path: "images/Design01-C-preview.png"
        }
    ],

    DA_1 = [
        A = {
            fullname: "DA_1_A",
            path: "images/Design02-A-preview.png"
        },
        B = {
            fullname: "DA_1_B",
            path: "images/Design02-B-preview.png"
        },
        C = {
            fullname: "DA_1_C",
            path: "images/Design02-C-preview.png"
        }
    ],

    DD_2 = [
        A = {
            fullname: "DD_2_A",
            path: "images/Design03-A-preview.png"
        },
        B = {
            fullname: "DD_2_B",
            path: "images/Design03-B-preview.png"
        },
        C = {
            fullname: "DD_2_C",
            path: "images/Design03-C-preview.png"
        }
    ],

    DR_3 = [
        A = {
            fullname: "DR_3_A",
            path: "images/Design04-A-preview.png"
        },
        B = {
            fullname: "DR_3_B",
            path: "images/Design04-B-preview.png"
        },
        C = {
            fullname: "DR_3_C",
            path: "images/Design04-C-preview.png"
        }
    ],

    DW_4 = [
        A = {
            fullname: "DW_4_A",
            path: "images/Design05-A-preview.png"
        },
        B = {
            fullname: "DW_4_B",
            path: "images/Design05-B-preview.png"
        },
        C = {
            fullname: "DW_4_C",
            path: "images/Design05-C-preview.png"
        }
    ],

    DT_5 = [
        A = {
            fullname: "DT_5_A",
            path: "images/Design06-A-preview.png"
        },
        B = {
            fullname: "DT_5_B",
            path: "images/Design06-B-preview.png"
        },
        C = {
            fullname: "DT_5_C",
            path: "images/Design06-C-preview.png"
        }
    ],

    DH_6 = [
        A = {
            fullname: "DH_6_A",
            path: "images/Design07-A-preview.png"
        },
        B = {
            fullname: "DH_6_B",
            path: "images/Design07-B-preview.png"
        },
        C = {
            fullname: "DH_6_C",
            path: "images/Design07-C-preview.png"
        }
    ],

    KS_1 = [
        A = {
            fullname: "KS_1_A",
            path: "images/Shape01-A-preview.png"
        },
        B = {
            fullname: "KS_1_B",
            path: "images/Shape01-B-preview.png"
        },
        C = {
            fullname: "KS_1_C",
            path: "images/Shape01-C-preview.png"
        }
    ],

    KH_2 = [
        A = {
            fullname: "KH_2_A",
            path: "images/Shape02-A-preview.png"
        },
        B = {
            fullname: "KH_2_B",
            path: "images/Shape02-B-preview.png"
        },
        C = {
            fullname: "KH_2_C",
            path: "images/Shape02-C-preview.png"
        }
    ],

    KP_3 = [
        A = {
            fullname: "KP_3_A",
            path: "images/Shape03-A-preview.png"
        },
        B = {
            fullname: "KP_3_B",
            path: "images/Shape03-B-preview.png"
        },
        C = {
            fullname: "KP_3_C",
            path: "images/Shape03-C-preview.png"
        }
    ],

    KH_4 = [
        A = {
            fullname: "KS_4_A",
            path: "images/Shape04-A-preview.png"
        },
        B = {
            fullname: "KS_4_B",
            path: "images/Shape04-B-preview.png"
        },
        C = {
            fullname: "KS_4_C",
            path: "images/Shape04-C-preview.png"
        }
    ]

]
