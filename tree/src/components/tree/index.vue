<template>
      <div class="tree" style="height:600px">
          <vue3-tree-org
          :data="data"
          :props="props"
          center
          :horizontal="horizontal"
          :collapsable="collapsable"
          :label-style="style"
          :only-one-node="onlyOneNode"
          :clone-node-drag="cloneNodeDrag"
          :before-drag-end="beforeDragEnd"
          expandAll = true
          @on-node-drag="nodeDragMove"
          @on-node-drag-end="nodeDragEnd"
          @on-contextmenu="onMenus"
          @on-expand="onExpand"
          @on-node-dblclick="onNodeDblclick"
          @on-node-click="onNodeClick"
        >
            </vue3-tree-org>
      </div>
</template>
<script>
import { ref } from 'vue'
export default {
  name: "baseTree",
  components: {
  },
  setup() {
    const cloneNodeDrag = ref(true)
    return {
      cloneNodeDrag
    }
  },
  data() {
    return {
      data: {
      },
      horizontal: false,
      collapsable: true,
      onlyOneNode: false,
      expandAll: true,
      disaled: false,
      style: {
        background: "#fff",
        color: "#5e6d82",
      },
      props:{
          id:'id',
          label:'label',
      }
    };
  },
  created() {
    this.toggleExpand(this.data, this.expandAll);
  },
    mounted(){
        console.log('mounted')
        this.getData()
        console.log('this.data',this.data)
    },
  methods: {
    async getData(){
        console.log('getData')
        const{data:res} = await this.$http.get('/user_lev/155')

        if(res.code == 200){
            let tree = res.data
            let configset = {
                horizontal: false,
                collapsable: true,
                onlyOneNode: true,
                cloneNodeDrag: true,
                expandAll: true,
                style: {
                    background: "#fff",
                    color: "#5e6d82",
                },
            }
            this.data = Object.assign({},tree,configset)
        //console.log(this.data)

        }else{
            console.log('False')
        }



    },
    onMenus({ node, command }) {
      console.log(node, command);
    },
    onExpand(e, data) {
      console.log(e, data);
    },
    onExpandAll(b) {
      console.log(b)
    },
    nodeDragMove(data) {
      console.log(data);
    },
    beforeDragEnd(node, targetNode) {
      return new Promise((resolve, reject) => {
        if (!targetNode) reject()
        if (node.id === targetNode.id) {
          reject()
        } else {
          resolve()
        }
      })
    },
    nodeDragEnd(data, isSelf) {
      console.log(data, isSelf);
    },
    onNodeDblclick() {
      console.log('onNodeDblclick')
    },
    onNodeClick(e, data) {
      ElMessage.info(data.label);
    },
    expandChange() {
      // this.toggleExpand(this.data, this.expandAll);
        this.toggleExpand(this.data, this.expandAll);
    },
    toggleExpand(data, val) {
      if (Array.isArray(data)) {
        data.forEach((item) => {
          item.expand = val
          if (item.children) {
            this.toggleExpand(item.children, val);
          }
        });
      } else {
        data.expand = val
        if (data.children) {
          this.toggleExpand(data.children, val);
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.tree{
    width: 100%;
}
</style>
