function TreeConstructor(strArr) { 
    // code goes here  
    let tree = strArr.map((x) => x.split(',').map((y) => parseInt(y)));
    let treeMap = new Map();
    let root = null;
    let isTree = true;
    for (let i = 0; i < tree.length; i++) {
      if (tree[i][0] === tree[i][1]) {
        isTree = false;
        break;
      }
      if (treeMap.has(tree[i][0])) {
        isTree = false;
        break;
      } else {
        treeMap.set(tree[i][0], tree[i][1]);
      }
      if (treeMap.has(tree[i][1])) {
        isTree = false;
        break;
      }
    }
    if (isTree) {
      for (let i = 0; i < tree.length; i++) {
        if (treeMap.has(tree[i][1])) {
          isTree = false;
          break;
        }
      }
    }
    return isTree;
  }

    // keep this function call here
    console.log(TreeConstructor(readline()));