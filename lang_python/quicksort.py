#! /usr/bin/env python

def quicksort(arr):
   if len(arr) <= 1: return arr
   m = arr[0]
   return quicksort([i for i in arr if i < m]) + \
          [i for i in arr if i == m] + \
          quicksort([i for i in arr if i > m])


arr = [5,99,2,45,12,234,29,0];
print('test quicksort:')
print(arr)
print(quicksort(arr))