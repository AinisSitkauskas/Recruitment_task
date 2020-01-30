# Commission task - Ainis Šitkauskas

Following steps to run this program:
- Install all necessary dependencies with `composer install`;
- Program works from terminal with `php script.php input.csv`;
- Program result is identical to given in example data;
- There are writen some tests, to run them  pass `composer run test`;
- If you have questions contact me `ainis795@gmail.com`.

# Example Data

```
➜  cat input.csv 
2014-12-31,4,natural,cash_out,1200.00,EUR
2015-01-01,4,natural,cash_out,1000.00,EUR
2016-01-05,4,natural,cash_out,1000.00,EUR
2016-01-05,1,natural,cash_in,200.00,EUR
2016-01-06,2,legal,cash_out,300.00,EUR
2016-01-06,1,natural,cash_out,30000,JPY
2016-01-07,1,natural,cash_out,1000.00,EUR
2016-01-07,1,natural,cash_out,100.00,USD
2016-01-10,1,natural,cash_out,100.00,EUR
2016-01-10,2,legal,cash_in,1000000.00,EUR
2016-01-10,3,natural,cash_out,1000.00,EUR
2016-02-15,1,natural,cash_out,300.00,EUR
2016-02-19,5,natural,cash_out,3000000,JPY
➜  php script.php input.csv
0.60
3.00
0.00
0.06
0.90
0
0.70
0.30
0.30
5.00
0.00
0.00
8612
```
