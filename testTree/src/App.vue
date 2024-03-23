<template>
    <div style="height: 800px;">
        <vue3-tree-org
            :data="data"
            :horizontal="horizontal"
            :collapsable="collapsable"
            :label-style="style"
            :node-draggable="true"
            :scalable="true"
            :only-one-node="onlyOneNode"
            :default-expand-level="1"
            :clone-node-drag="cloneNodeDrag"
            @on-contextmenu="onMenus"
            @on-node-click="onNodeClick"
        >
            <!-- 自定义节点内容 -->
            <template v-slot="{node}">
                <div class="tree-org-node__text node-label">
                    <div>id:{{node.id}}</div>
                    <div>用户名:{{node.label}}</div>
                    <div>电话：{{data.phone}}</div>
                    <div>积分：{{data.integral}}</div>
                </div>
            </template>
        </vue3-tree-org>
    </div>
</template>
<script>
import { ElSwitch, ElColorPicker, ElMessage } from 'element-plus'
import { ref } from 'vue'
export default {
  name: "baseTree",
  components: {
    ElSwitch,
    ElColorPicker
  },
  setup() {
    const cloneNodeDrag = ref(true)
    return {
      cloneNodeDrag
    }
  },
  data() {
    return {
        data:{


              "id": 6,
    "label": "商城主用户",
    "children": [
        {
            "id": 155,
            "phone": "13300000001",
            "label": "A",
            "integral": "0.00",
            "children": [
                {
                    "id": 161,
                    "phone": "13300000007",
                    "label": "AA",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 170,
                            "phone": "13300000016",
                            "label": "AAA",
                            "integral": "0.00",
                            "children": [
                                {
                                    "id": 185,
                                    "phone": "13300000031",
                                    "label": "AAAA",
                                    "integral": "4800.00",
                                    "children": null
                                }
                            ]
                        },
                        {
                            "id": 171,
                            "phone": "13300000017",
                            "label": "AAB",
                            "integral": "0.00",
                            "children": [
                                {
                                    "id": 186,
                                    "phone": "13300000032",
                                    "label": "AABA",
                                    "integral": "3600.00",
                                    "children": null
                                }
                            ]
                        }
                    ]
                },
                {
                    "id": 162,
                    "phone": "13300000008",
                    "label": "AB",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 172,
                            "phone": "13300000018",
                            "label": "ABA",
                            "integral": "0.00",
                            "children": [
                                {
                                    "id": 187,
                                    "phone": "13300000033",
                                    "label": "ABAA",
                                    "integral": "4800.00",
                                    "children": null
                                }
                            ]
                        },
                        {
                            "id": 173,
                            "phone": "13300000019",
                            "label": "ABB",
                            "integral": "0.00",
                            "children": [
                                {
                                    "id": 188,
                                    "phone": "13300000034",
                                    "label": "ABBA",
                                    "integral": "2400.00",
                                    "children": null
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "id": 156,
            "phone": "13300000002",
            "label": "B",
            "integral": "0.00",
            "children": [
                {
                    "id": 163,
                    "phone": "13300000009",
                    "label": "BA",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 174,
                            "phone": "13300000020",
                            "label": "BAA",
                            "integral": "4800.00",
                            "children": null
                        }
                    ]
                },
                {
                    "id": 164,
                    "phone": "13300000010",
                    "label": "BB",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 175,
                            "phone": "13300000021",
                            "label": "BBA",
                            "integral": "0.00",
                            "children": [
                                {
                                    "id": 189,
                                    "phone": "13300000035",
                                    "label": "BBAA",
                                    "integral": "5000.00",
                                    "children": [
                                        {
                                            "id": 193,
                                            "phone": "13300000039",
                                            "label": "BBAAA",
                                            "integral": "4800.00",
                                            "children": null
                                        }
                                    ]
                                },
                                {
                                    "id": 190,
                                    "phone": "13300000036",
                                    "label": "BBAB",
                                    "integral": "5000.00",
                                    "children": [
                                        {
                                            "id": 194,
                                            "phone": "13300000040",
                                            "label": "BBABA",
                                            "integral": "4800.00",
                                            "children": null
                                        }
                                    ]
                                },
                                {
                                    "id": 191,
                                    "phone": "13300000037",
                                    "label": "BBAC",
                                    "integral": "5000.00",
                                    "children": [
                                        {
                                            "id": 195,
                                            "phone": "13300000041",
                                            "label": "BBACA",
                                            "integral": "4800.00",
                                            "children": null
                                        }
                                    ]
                                },
                                {
                                    "id": 192,
                                    "phone": "13300000038",
                                    "label": "BBAD",
                                    "integral": "5000.00",
                                    "children": [
                                        {
                                            "id": 196,
                                            "phone": "13300000042",
                                            "label": "BBADA",
                                            "integral": "4800.00",
                                            "children": null
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                },
                {
                    "id": 165,
                    "phone": "13300000011",
                    "label": "BC",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 176,
                            "phone": "13300000022",
                            "label": "BCA",
                            "integral": "4800.00",
                            "children": null
                        }
                    ]
                }
            ]
        },
        {
            "id": 157,
            "phone": "13300000003",
            "label": "C",
            "integral": "0.00",
            "children": [
                {
                    "id": 166,
                    "phone": "13300000012",
                    "label": "CA",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 177,
                            "phone": "13300000023",
                            "label": "CAA",
                            "integral": "4800.00",
                            "children": null
                        }
                    ]
                }
            ]
        },
        {
            "id": 158,
            "phone": "13300000004",
            "label": "D",
            "integral": "0.00",
            "children": [
                {
                    "id": 167,
                    "phone": "13300000013",
                    "label": "DA",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 178,
                            "phone": "13300000024",
                            "label": "DAA",
                            "integral": "4800.00",
                            "children": null
                        }
                    ]
                }
            ]
        },
        {
            "id": 159,
            "phone": "13300000005",
            "label": "E",
            "integral": "0.00",
            "children": [
                {
                    "id": 168,
                    "phone": "13300000014",
                    "label": "EA",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 179,
                            "phone": "13300000025",
                            "label": "EAA",
                            "integral": "4800.00",
                            "children": null
                        }
                    ]
                }
            ]
        },
        {
            "id": 160,
            "phone": "13300000006",
            "label": "F",
            "integral": "0.00",
            "children": [
                {
                    "id": 169,
                    "phone": "13300000015",
                    "label": "FA",
                    "integral": "0.00",
                    "children": [
                        {
                            "id": 180,
                            "phone": "13300000026",
                            "label": "FAA",
                            "integral": "1000.00",
                            "children": [
                                {
                                    "id": 197,
                                    "phone": "13300000043",
                                    "label": "FAAA",
                                    "integral": "0.00",
                                    "children": [
                                        {
                                            "id": 202,
                                            "phone": "13300000048",
                                            "label": "FAAAA",
                                            "integral": "4800.00",
                                            "children": null
                                        },
                                        {
                                            "id": 203,
                                            "phone": "13300000049",
                                            "label": "FAAAB",
                                            "integral": "1000.00",
                                            "children": null
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            "id": 181,
                            "phone": "13300000027",
                            "label": "FAB",
                            "integral": "5000.00",
                            "children": [
                                {
                                    "id": 198,
                                    "phone": "13300000044",
                                    "label": "FABA",
                                    "integral": "4800.00",
                                    "children": null
                                }
                            ]
                        },
                        {
                            "id": 182,
                            "phone": "13300000028",
                            "label": "FAC",
                            "integral": "5000.00",
                            "children": [
                                {
                                    "id": 199,
                                    "phone": "13300000045",
                                    "label": "FACA",
                                    "integral": "4800.00",
                                    "children": null
                                }
                            ]
                        },
                        {
                            "id": 183,
                            "phone": "13300000029",
                            "label": "FAD",
                            "integral": "4500.00",
                            "children": [
                                {
                                    "id": 200,
                                    "phone": "13300000046",
                                    "label": "FADA",
                                    "integral": "4800.00",
                                    "children": null
                                }
                            ]
                        },
                        {
                            "id": 184,
                            "phone": "13300000030",
                            "label": "FAE",
                            "integral": "4500.00",
                            "children": [
                                {
                                    "id": 201,
                                    "phone": "13300000047",
                                    "label": "FAEA",
                                    "integral": "4800.00",
                                    "children": null
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]

        },
      //horizontal: true,
      horizontal: false,
      collapsable: true,
      onlyOneNode: false,
      expandAll: true,
      disaled: false,
      style: {
        background: "#fff",
        color: "#5e6d82",
      },
    };
  },
  created() {
    // this.toggleExpand(this.data, this.expandAll);
  },
    


    methods: {
    onMenus({ node, command }) {
        console.log('onMenus')
      console.log(node, command);
    },
    onNodeClick(e, data) {
      this.$Message.info(data.label);
    },
    expandChange() {
        console.log("expand")
      this.toggleExpand(this.data, this.expandAll);
    },
  },
 };
</script>

