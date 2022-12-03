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

    TemplateColor: {
        0: [1],
        1: [1],
        2: [1],
        3: [1],
        4: [1],
        5: [1],
        6: [1],
        7: [1],
        8: [1],
        9: [2, 3, 4, 5, 6],
        10: [2, 3, 4, 5, 6],
        11: [2, 3, 4, 5, 6],
        12: [1],
        13: [1],
        14: [1],
        15: [2, 3, 4, 5, 6],
        16: [2, 3, 4, 5, 6],
        17: [2, 3, 4, 5, 6],
        18: [2, 3, 4, 5, 6],
        19: [2, 3, 4, 5, 6],
        20: [2, 3, 4, 5, 6],
        21: [1, 2, 3, 4, 5, 6],
        22: [1, 2, 3, 4, 5, 6],
        23: [1, 2, 3, 4, 5, 6],
        24: [1, 2, 3, 4, 5, 6],
        25: [1, 2, 3, 4, 5, 6],
        26: [1, 2, 3, 4, 5, 6],
        27: [1, 2, 3, 4, 5, 6],
        28: [1, 2, 3, 4, 5, 6],
        29: [1, 2, 3, 4, 5, 6],
        30: [1, 2, 3, 4, 5, 6],
        31: [1, 2, 3, 4, 5, 6],
        32: [1, 2, 3, 4, 5, 6]

    }

}

//------------------------------------------------------------------------
//  テンプレートの寸法、名前
//------------------------------------------------------------------------
const Template = [
    DJ_0 = [
        A = {
            length: 305,
            width: 230,
            depth: 150,
            fullname: "DJ_0_A"
        },
        B = {
            length: 218,
            width: 178,
            depth: 114,
            fullname: "DJ_0_B"
        },
        C = {
            length: 109,
            width: 89,
            depth: 110,
            fullname: "DJ_0_C"
        },
        P = {
            face1: "images/PreviewInitImages/TemplateTextures/DJ_1_1.jpg",
            face2: "images/PreviewInitImages/TemplateTextures/DJ_1_2.jpg",
            face3: "images/PreviewInitImages/TemplateTextures/DJ_1_3.jpg",
            face4: "images/PreviewInitImages/TemplateTextures/DJ_1_4.jpg",
            face5: "images/PreviewInitImages/TemplateTextures/DJ_1_5.jpg",
            face6: "images/PreviewInitImages/TemplateTextures/DJ_1_6.jpg"
        }
    ],

    DA_1 = [
        A = {
            length: 305,
            width: 230,
            depth: 150,
            fullname: "DA_1_A"
        },
        B = {
            length: 218,
            width: 178,
            depth: 114,
            fullname: "DA_1_B"
        },
        C = {
            length: 109,
            width: 89,
            depth: 110,
            fullname: "DA_1_C"
        },
        P = {
            face1: "images/PreviewInitImages/TemplateTextures/DA_2_1.jpg",
            face2: "images/PreviewInitImages/TemplateTextures/DA_2_2.jpg",
            face3: "images/PreviewInitImages/TemplateTextures/DA_2_3.jpg",
            face4: "images/PreviewInitImages/TemplateTextures/DA_2_4.jpg",
            face5: "images/PreviewInitImages/TemplateTextures/DA_2_5.jpg",
            face6: "images/PreviewInitImages/TemplateTextures/DA_2_6.jpg"
        }
    ],

    DD_2 = [
        A = {
            length: 305,
            width: 230,
            depth: 150,
            fullname: "DD_2_A"
        },
        B = {
            length: 218,
            width: 178,
            depth: 114,
            fullname: "DD_2_B"
        },
        C = {
            length: 109,
            width: 89,
            depth: 110,
            fullname: "DD_2_C"
        },
        P = {
            face1: "images/PreviewInitImages/TemplateTextures/DD_3_1.jpg",
            face2: "images/PreviewInitImages/TemplateTextures/DD_3_2.jpg",
            face3: "images/PreviewInitImages/TemplateTextures/DD_3_3.jpg",
            face4: "images/PreviewInitImages/TemplateTextures/DD_3_4.jpg",
            face5: "images/PreviewInitImages/TemplateTextures/DD_3_5.jpg",
            face6: "images/PreviewInitImages/TemplateTextures/DD_3_6.jpg"
        }
    ],

    DR_3 = [
        A = {
            length: 305,
            width: 230,
            depth: 150,
            fullname: "DR_3_A"
        },
        B = {
            length: 218,
            width: 178,
            depth: 114,
            fullname: "DR_3_B"
        },
        C = {
            length: 109,
            width: 89,
            depth: 110,
            fullname: "DR_3_C"
        },
        P = {
            face1: "images/PreviewInitImages/TemplateTextures/DR_4_1.jpg",
            face2: "images/PreviewInitImages/TemplateTextures/DR_4_2.jpg",
            face3: "images/PreviewInitImages/TemplateTextures/DR_4_3.jpg",
            face4: "images/PreviewInitImages/TemplateTextures/DR_4_4.jpg",
            face5: "images/PreviewInitImages/TemplateTextures/DR_4_5.jpg",
            face6: "images/PreviewInitImages/TemplateTextures/DR_4_6.jpg"
        }
    ],

    DW_4 = [
        A = {
            length: 450,
            width: 350,
            depth: 150,
            fullname: "DW_4_A"
        },
        B = {
            length: 400,
            width: 300,
            depth: 100,
            fullname: "DW_4_B"
        },
        C = {
            length: 305,
            width: 230,
            depth: 75,
            fullname: "DW_4_C"
        }
    ],

    DT_5 = [
        A = {
            length: 470,
            width: 330,
            depth: 350,
            fullname: "DT_5_A"
        },
        B = {
            length: 279,
            width: 152,
            depth: 149,
            fullname: "DT_5_B"
        },
        C = {
            length: 163,
            width: 120,
            depth: 94,
            fullname: "DT_5_C"
        }
    ],

    DH_6 = [
        A = {
            length: 224,
            width: 210,
            depth: 96,
            fullname: "DH_6_A"
        },
        B = {
            length: 110,
            width: 100,
            depth: 50,
            fullname: "DH_6_B"
        },
        C = {
            length: 94,
            width: 90,
            depth: 25,
            fullname: "DH_6_C"
        }
    ]
]