SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for payment
-- ----------------------------
CREATE TABLE `payment`  (
  `scb_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `confirmId` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL UNIQUE,
  `transactionId` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `amount` int(4) UNSIGNED NOT NULL,
  `amount_muliple` int(4) UNSIGNED NOT NULL,  
  `status` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `added_time` datetime NOT NULL,
  `item_add` int(11) UNSIGNED NULL,
  `qty_add` int(11) UNSIGNED NULL,
  `item_add_1` int(11) UNSIGNED NULL,
  `qty_add_1` int(11) UNSIGNED NULL,
  `item_add_2` int(11) UNSIGNED NULL,
  `qty_add_2` int(11) UNSIGNED NULL,
  `item_add_3` int(11) UNSIGNED NULL,
  `qty_add_3` int(11) UNSIGNED NULL,
  `item_add_4` int(11) UNSIGNED NULL,
  `qty_add_4` int(11) UNSIGNED NULL,
  `item_add_5` int(11) UNSIGNED NULL,
  `qty_add_5` int(11) UNSIGNED NULL,
  `item_add_6` int(11) UNSIGNED NULL,
  `qty_add_6` int(11) UNSIGNED NULL,
  `item_add_7` int(11) UNSIGNED NULL,
  `qty_add_7` int(11) UNSIGNED NULL,
  `item_add_8` int(11) UNSIGNED NULL,
  `qty_add_8` int(11) UNSIGNED NULL,
  `item_add_9` int(11) UNSIGNED NULL,
  `qty_add_9` int(11) UNSIGNED NULL,
  `item_add_10` int(11) UNSIGNED NULL,
  `qty_add_10` int(11) UNSIGNED NULL,
  `item_add_11` int(11) UNSIGNED NULL,
  `qty_add_11` int(11) UNSIGNED NULL,
  `item_add_12` int(11) UNSIGNED NULL,
  `qty_add_12` int(11) UNSIGNED NULL,
  `item_add_13` int(11) UNSIGNED NULL,
  `qty_add_13` int(11) UNSIGNED NULL,
  `item_add_14` int(11) UNSIGNED NULL,
  `qty_add_14` int(11) UNSIGNED NULL,
  `item_add_15` int(11) UNSIGNED NULL,
  `qty_add_15` int(11) UNSIGNED NULL,
  `item_add_16` int(11) UNSIGNED NULL,
  `qty_add_16` int(11) UNSIGNED NULL,
  `item_add_17` int(11) UNSIGNED NULL,
  `qty_add_17` int(11) UNSIGNED NULL,
  `item_add_18` int(11) UNSIGNED NULL,
  `qty_add_18` int(11) UNSIGNED NULL,
  `item_add_19` int(11) UNSIGNED NULL,
  `qty_add_19` int(11) UNSIGNED NULL,
  `item_add_20` int(11) UNSIGNED NULL,
  `qty_add_20` int(11) UNSIGNED NULL,
  PRIMARY KEY (`scb_id`) USING BTREE,
  INDEX `scb_id`(`scb_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;